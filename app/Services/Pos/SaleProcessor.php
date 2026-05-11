<?php

namespace App\Services\Pos;

use App\Models\Branch;
use App\Models\Business;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\InventoryLog;
use App\Models\Membership;
use App\Models\MpesaTransaction;
use App\Models\Payment;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Service;
use App\Models\Staff;
use App\Support\PosOptions;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

class SaleProcessor
{
    public function __construct(private readonly PosReferenceGenerator $referenceGenerator)
    {
    }

    public function process(Business $business, array $data): Sale
    {
        return DB::transaction(function () use ($business, $data): Sale {
            $branch = $this->resolveBranch($business, $data['branch_id'] ?? null);
            $appointment = $this->resolveAppointment($business, $data['appointment_id'] ?? null);
            $customer = $this->resolveCustomer($business, $data['customer_id'] ?? $appointment?->customer_id);
            $saleStaff = $this->resolveStaff($business, $data['staff_id'] ?? $appointment?->staff_id);
            $membership = $customer?->membership;
            $membershipType = $membership?->membership_type ?? 'Silver';
            $requestedRedeemedPoints = (int) ($data['loyalty_points_to_redeem'] ?? 0);
            $redeemedPoints = $customer ? min($requestedRedeemedPoints, $customer->loyalty_points) : 0;

            if ($customer && $requestedRedeemedPoints > $customer->loyalty_points) {
                throw ValidationException::withMessages([
                    'loyalty_points_to_redeem' => 'The selected customer does not have enough loyalty points.',
                ]);
            }

            $draftLines = array_merge(
                $this->buildServiceDrafts($business, $data['service_items'] ?? [], $saleStaff),
                $this->buildProductDrafts($business, $data['product_items'] ?? [], $saleStaff),
                $this->buildPackageDrafts($business, $data['package_items'] ?? [], $saleStaff),
            );

            if ($draftLines === []) {
                throw ValidationException::withMessages([
                    'service_items' => 'Add at least one service, product, or package to the sale.',
                ]);
            }

            $subtotal = round(collect($draftLines)->sum('line_subtotal'), 2);
            $lineDiscounts = round(collect($draftLines)->sum('discount_amount'), 2);
            $saleLevelDiscount = round((float) ($data['discount_amount'] ?? 0), 2) + $redeemedPoints;
            $netBeforeSaleDiscount = round($subtotal - $lineDiscounts, 2);

            if ($saleLevelDiscount > $netBeforeSaleDiscount) {
                throw ValidationException::withMessages([
                    'discount_amount' => 'The total discount cannot exceed the sale subtotal.',
                ]);
            }

            $draftCount = count($draftLines);
            $remainingSaleLevelDiscount = $saleLevelDiscount;

            foreach ($draftLines as $index => $draft) {
                $netBeforeAllocation = round($draft['line_subtotal'] - $draft['discount_amount'], 2);

                if ($index === $draftCount - 1) {
                    $allocated = round($remainingSaleLevelDiscount, 2);
                } else {
                    $allocated = $netBeforeSaleDiscount > 0
                        ? round(($netBeforeAllocation / $netBeforeSaleDiscount) * $saleLevelDiscount, 2)
                        : 0;
                    $allocated = min($allocated, $remainingSaleLevelDiscount);
                    $remainingSaleLevelDiscount = round($remainingSaleLevelDiscount - $allocated, 2);
                }

                $totalDiscount = round($draft['discount_amount'] + $allocated, 2);
                $taxableAmount = round(max($draft['line_subtotal'] - $totalDiscount, 0), 2);
                $vatAmount = round($taxableAmount * ($draft['vat_rate'] / 100), 2);
                $lineTotal = round($taxableAmount + $vatAmount, 2);
                [$commissionType, $commissionRate, $commissionAmount] = $this->resolveCommission($draft, $taxableAmount);

                $draft['discount_amount'] = $totalDiscount;
                $draft['vat_amount'] = $vatAmount;
                $draft['line_total'] = $lineTotal;
                $draft['commission_type'] = $commissionType;
                $draft['commission_rate'] = $commissionRate;
                $draft['commission_amount'] = $commissionAmount;

                $draftLines[$index] = $draft;
            }

            $vatAmount = round(collect($draftLines)->sum('vat_amount'), 2);
            $totalAmount = round(collect($draftLines)->sum('line_total'), 2);
            $payments = collect($data['payments'] ?? [])->filter(fn (array $payment): bool => (float) ($payment['amount'] ?? 0) > 0)->values();

            if ($payments->isEmpty()) {
                throw ValidationException::withMessages([
                    'payments' => 'Add at least one payment row.',
                ]);
            }

            $amountPaid = round($payments->where('status', 'Paid')->sum(fn (array $payment): float => (float) $payment['amount']), 2);
            $balanceAmount = round(max($totalAmount - $amountPaid, 0), 2);
            $paymentMethod = $payments->pluck('payment_method')->unique()->count() > 1
                ? 'Split Payment'
                : (string) $payments->first()['payment_method'];
            $transactionDate = Carbon::parse($data['transaction_date']);

            $sale = Sale::query()->create([
                'business_id' => $business->id,
                'branch_id' => $branch?->id,
                'appointment_id' => $appointment?->id,
                'customer_id' => $customer?->id,
                'staff_id' => $saleStaff?->id,
                'receipt_number' => $this->referenceGenerator->next(
                    business: $business,
                    prefix: 'RCPT',
                    query: Sale::query()->where('business_id', $business->id),
                    column: 'receipt_number',
                ),
                'transaction_date' => $transactionDate,
                'subtotal' => $subtotal,
                'discount_amount' => round($lineDiscounts + $saleLevelDiscount, 2),
                'vat_amount' => $vatAmount,
                'total_amount' => $totalAmount,
                'payment_method' => $paymentMethod,
                'amount_paid' => $amountPaid,
                'balance_amount' => $balanceAmount,
                'sales_channel' => $data['sales_channel'],
                'loyalty_points_earned' => 0,
                'loyalty_points_redeemed' => $redeemedPoints,
                'currency' => 'KES',
                'notes' => $data['notes'] ?? null,
                'closed_at' => $balanceAmount <= 0 ? now() : null,
            ]);

            foreach ($draftLines as $draft) {
                $saleItem = $sale->items()->create([
                    'business_id' => $business->id,
                    'service_id' => $draft['service']?->id,
                    'product_id' => $draft['product']?->id,
                    'staff_id' => $draft['staff']?->id,
                    'item_type' => $draft['item_type'],
                    'description' => $draft['description'],
                    'quantity' => $draft['quantity'],
                    'unit_price' => $draft['unit_price'],
                    'line_subtotal' => $draft['line_subtotal'],
                    'discount_amount' => $draft['discount_amount'],
                    'vat_rate' => $draft['vat_rate'],
                    'vat_amount' => $draft['vat_amount'],
                    'line_total' => $draft['line_total'],
                    'commission_type' => $draft['commission_type'],
                    'commission_rate' => $draft['commission_rate'],
                    'commission_amount' => $draft['commission_amount'],
                    'metadata' => $draft['metadata'],
                ]);

                if ($draft['commission_amount'] > 0 && $draft['staff']) {
                    Commission::query()->create([
                        'business_id' => $business->id,
                        'sale_id' => $sale->id,
                        'sale_item_id' => $saleItem->id,
                        'staff_id' => $draft['staff']->id,
                        'source_type' => $draft['item_type'],
                        'commission_type' => $draft['commission_type'],
                        'commission_rate' => $draft['commission_rate'],
                        'eligible_amount' => round($draft['line_total'] - $draft['vat_amount'], 2),
                        'commission_amount' => $draft['commission_amount'],
                        'commission_date' => $transactionDate->toDateString(),
                        'notes' => $draft['description'],
                    ]);
                }

                if ($draft['product']) {
                    $this->adjustInventory(
                        business: $business,
                        branch: $branch,
                        product: $draft['product'],
                        quantityToDeduct: (float) $draft['quantity'],
                        reason: 'sale',
                        sale: $sale,
                    );
                }

                if ($draft['item_type'] === 'service' && ($draft['metadata']['deduct_products'] ?? false) && $draft['service']) {
                    $requiredProducts = collect($draft['service']->required_products ?? []);

                    $requiredProducts->each(function (array $requiredProduct) use ($business, $branch, $draft, $sale): void {
                        $productId = $requiredProduct['product_id'] ?? null;
                        $quantity = (float) ($requiredProduct['quantity'] ?? 0);

                        if (! $productId || $quantity <= 0) {
                            return;
                        }

                        $product = $business->products()->whereKey($productId)->first();

                        if (! $product) {
                            return;
                        }

                        $this->adjustInventory(
                            business: $business,
                            branch: $branch,
                            product: $product,
                            quantityToDeduct: round($quantity * (float) $draft['quantity'], 2),
                            reason: 'service_use',
                            sale: $sale,
                        );
                    });
                }
            }

            foreach ($payments as $paymentData) {
                $payment = Payment::query()->create([
                    'business_id' => $business->id,
                    'sale_id' => $sale->id,
                    'customer_id' => $customer?->id,
                    'payment_method' => $paymentData['payment_method'],
                    'amount' => $paymentData['amount'],
                    'status' => $paymentData['status'],
                    'reference' => $paymentData['reference'] ?? null,
                    'paid_at' => ! empty($paymentData['paid_at']) ? Carbon::parse($paymentData['paid_at']) : ($paymentData['status'] === 'Paid' ? $transactionDate : null),
                    'metadata' => [
                        'notes' => $paymentData['notes'] ?? null,
                    ],
                    'notes' => $paymentData['notes'] ?? null,
                ]);

                if ($paymentData['payment_method'] === 'M-Pesa') {
                    MpesaTransaction::query()->create([
                        'business_id' => $business->id,
                        'sale_id' => $sale->id,
                        'payment_id' => $payment->id,
                        'mpesa_code' => $paymentData['mpesa_code'],
                        'phone_number' => KenyaPhoneNumber::normalize($paymentData['phone_number']) ?? $paymentData['phone_number'],
                        'till_or_paybill' => $paymentData['till_or_paybill'],
                        'payment_status' => $paymentData['status'],
                        'transaction_time' => ! empty($paymentData['paid_at']) ? Carbon::parse($paymentData['paid_at']) : $transactionDate,
                        'linked_receipt_number' => $sale->receipt_number,
                    ]);
                }
            }

            if ($customer) {
                $pointsEarned = PosOptions::loyaltyPointsForAmount($totalAmount - $vatAmount, $membershipType);
                $updatedBalance = max($customer->loyalty_points - $redeemedPoints, 0) + $pointsEarned;

                $customer->update([
                    'last_visit_date' => $transactionDate->toDateString(),
                    'loyalty_points' => $updatedBalance,
                ]);

                $membership ??= Membership::query()->create([
                    'business_id' => $business->id,
                    'customer_id' => $customer->id,
                    'membership_number' => $this->referenceGenerator->next(
                        business: $business,
                        prefix: 'MEM',
                        query: Membership::query()->where('business_id', $business->id),
                        column: 'membership_number',
                    ),
                    'membership_type' => 'Silver',
                    'points_earned' => 0,
                    'points_redeemed' => 0,
                    'reward_balance' => 0,
                    'membership_expiry_date' => now()->addYear()->toDateString(),
                    'is_active' => true,
                ]);

                $membership->update([
                    'points_earned' => $membership->points_earned + $pointsEarned,
                    'points_redeemed' => $membership->points_redeemed + $redeemedPoints,
                    'reward_balance' => $updatedBalance,
                ]);

                $sale->update([
                    'loyalty_points_earned' => $pointsEarned,
                ]);

                $customer->loyaltyTransactions()->create([
                    'business_id' => $business->id,
                    'sale_id' => $sale->id,
                    'points_earned' => $pointsEarned,
                    'points_redeemed' => $redeemedPoints,
                    'balance_after' => $updatedBalance,
                    'description' => 'Sale '.$sale->receipt_number,
                    'recorded_at' => now(),
                ]);
            }

            if ($appointment) {
                $appointment->update([
                    'status' => 'Completed',
                ]);
            }

            return $sale->load([
                'appointment',
                'customer.membership',
                'items.staff',
                'payments.mpesaTransaction',
                'staff',
            ]);
        });
    }

    private function buildServiceDrafts(Business $business, array $items, ?Staff $defaultStaff): array
    {
        $drafts = [];

        foreach ($items as $row) {
            if (empty($row['service_id'])) {
                continue;
            }

            $service = $business->services()->whereKey($row['service_id'])->firstOrFail();
            $quantity = max((float) ($row['quantity'] ?? 1), 1);
            $discount = max((float) ($row['discount_amount'] ?? 0), 0);
            $staff = $this->resolveStaff($business, $row['staff_id'] ?? $defaultStaff?->id);

            $drafts[] = [
                'item_type' => 'service',
                'service' => $service,
                'product' => null,
                'staff' => $staff,
                'description' => $service->name,
                'quantity' => $quantity,
                'unit_price' => (float) $service->price,
                'line_subtotal' => round($quantity * (float) $service->price, 2),
                'discount_amount' => $discount,
                'vat_rate' => $service->vat_applicable ? (float) $service->vat_rate : 0,
                'metadata' => [
                    'deduct_products' => (bool) ($row['deduct_products'] ?? false),
                ],
            ];
        }

        return $drafts;
    }

    private function buildProductDrafts(Business $business, array $items, ?Staff $defaultStaff): array
    {
        $drafts = [];

        foreach ($items as $row) {
            if (empty($row['product_id'])) {
                continue;
            }

            $product = $business->products()->whereKey($row['product_id'])->firstOrFail();
            $quantity = max((float) ($row['quantity'] ?? 1), 0.01);
            $discount = max((float) ($row['discount_amount'] ?? 0), 0);
            $staff = $this->resolveStaff($business, $row['staff_id'] ?? $defaultStaff?->id);

            $drafts[] = [
                'item_type' => 'product',
                'service' => null,
                'product' => $product,
                'staff' => $staff,
                'description' => $product->name,
                'quantity' => $quantity,
                'unit_price' => (float) $product->selling_price,
                'line_subtotal' => round($quantity * (float) $product->selling_price, 2),
                'discount_amount' => $discount,
                'vat_rate' => (float) $product->vat_rate,
                'metadata' => [],
            ];
        }

        return $drafts;
    }

    private function buildPackageDrafts(Business $business, array $items, ?Staff $defaultStaff): array
    {
        $drafts = [];

        foreach ($items as $row) {
            if (blank($row['name'] ?? null)) {
                continue;
            }

            $quantity = max((float) ($row['quantity'] ?? 1), 1);
            $unitPrice = max((float) ($row['unit_price'] ?? 0), 0);
            $discount = max((float) ($row['discount_amount'] ?? 0), 0);
            $staff = $this->resolveStaff($business, $row['staff_id'] ?? $defaultStaff?->id);

            $drafts[] = [
                'item_type' => 'package',
                'service' => null,
                'product' => null,
                'staff' => $staff,
                'description' => (string) $row['name'],
                'quantity' => $quantity,
                'unit_price' => $unitPrice,
                'line_subtotal' => round($quantity * $unitPrice, 2),
                'discount_amount' => $discount,
                'vat_rate' => 0,
                'metadata' => [],
            ];
        }

        return $drafts;
    }

    private function resolveCommission(array $draft, float $eligibleAmount): array
    {
        $staff = $draft['staff'];

        if (! $staff) {
            return [null, null, 0];
        }

        if ($draft['item_type'] === 'service' && $draft['service']) {
            $type = $draft['service']->commission_type ?: $staff->commission_type;
            $rate = $draft['service']->commission_rate ?? $staff->commission_rate;

            return [$type, $rate, $this->calculateCommissionAmount($type, $rate, $eligibleAmount, $draft['quantity'])];
        }

        if ($draft['item_type'] === 'product' && $draft['product'] && $draft['product']->commission_enabled && $staff->can_receive_product_commission) {
            $type = $draft['product']->commission_type ?: $staff->commission_type;
            $rate = $draft['product']->commission_rate ?? $staff->commission_rate;

            return [$type, $rate, $this->calculateCommissionAmount($type, $rate, $eligibleAmount, $draft['quantity'])];
        }

        return [null, null, 0];
    }

    private function calculateCommissionAmount(?string $type, mixed $rate, float $eligibleAmount, float $quantity): float
    {
        $rateValue = (float) ($rate ?? 0);

        if ($rateValue <= 0 || ! $type) {
            return 0;
        }

        if ($type === 'Fixed') {
            return round($rateValue * $quantity, 2);
        }

        return round($eligibleAmount * ($rateValue / 100), 2);
    }

    private function adjustInventory(
        Business $business,
        ?Branch $branch,
        Product $product,
        float $quantityToDeduct,
        string $reason,
        Sale $sale,
    ): void {
        $before = (float) $product->current_stock;
        $after = round($before - $quantityToDeduct, 2);

        if ($after < 0) {
            throw ValidationException::withMessages([
                'product_items' => 'Insufficient stock for '.$product->name.'.',
            ]);
        }

        $product->update([
            'current_stock' => $after,
        ]);

        InventoryLog::query()->create([
            'business_id' => $business->id,
            'branch_id' => $branch?->id,
            'product_id' => $product->id,
            'sale_id' => $sale->id,
            'appointment_id' => $sale->appointment_id,
            'quantity_change' => -1 * $quantityToDeduct,
            'stock_before' => $before,
            'stock_after' => $after,
            'reason' => $reason,
            'notes' => $sale->receipt_number,
            'logged_at' => now(),
        ]);
    }

    private function resolveBranch(Business $business, mixed $branchId): ?Branch
    {
        if (! $branchId) {
            return $business->primaryBranch()->first();
        }

        return $business->branches()->whereKey($branchId)->firstOrFail();
    }

    private function resolveCustomer(Business $business, mixed $customerId): ?Customer
    {
        if (! $customerId) {
            return null;
        }

        return $business->customers()->whereKey($customerId)->firstOrFail();
    }

    private function resolveStaff(Business $business, mixed $staffId): ?Staff
    {
        if (! $staffId) {
            return null;
        }

        return $business->staffMembers()->whereKey($staffId)->firstOrFail();
    }

    private function resolveAppointment(Business $business, mixed $appointmentId): ?\App\Models\Appointment
    {
        if (! $appointmentId) {
            return null;
        }

        return $business->appointments()->whereKey($appointmentId)->firstOrFail();
    }
}
