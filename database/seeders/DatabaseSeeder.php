<?php

namespace Database\Seeders;

use App\Models\Appointment;
use App\Models\Branch;
use App\Models\Business;
use App\Models\Commission;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\InventoryLog;
use App\Models\LoyaltyPoint;
use App\Models\Membership;
use App\Models\MpesaTransaction;
use App\Models\Payment;
use App\Models\Product;
use App\Models\RoomChair;
use App\Models\Sale;
use App\Models\SaleItem;
use App\Models\Service;
use App\Models\Staff;
use App\Models\User;
use App\Support\BusinessConsoleSchema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    public function run(): void
    {
        User::query()->updateOrCreate(
            ['email' => 'admin@bookrahisi.test'],
            array_filter([
                'name' => 'Book Rahisi Owner',
                'phone_number' => '+254700000010',
                'password' => 'password',
                'is_admin' => true,
                'account_status' => 'active',
                'business_role' => BusinessConsoleSchema::hasBusinessRoleColumn() ? 'Admin' : null,
            ], static fn ($value) => $value !== null)
        );

        $customerUser = User::query()->updateOrCreate(
            ['email' => 'test@example.com'],
            [
                'name' => 'Test Customer',
                'phone_number' => '+254700000011',
                'password' => 'password',
                'is_admin' => false,
                'account_status' => 'active',
            ]
        );

        if (! Schema::hasTable('branches')) {
            return;
        }

        User::query()->updateOrCreate(
            ['email' => 'owner@bookrahisi.test'],
            array_filter([
                'name' => 'Amina Njeri',
                'phone_number' => '+254711223344',
                'password' => 'password',
                'is_admin' => false,
                'account_status' => 'active',
                'business_role' => BusinessConsoleSchema::hasBusinessRoleColumn() ? 'Admin' : null,
            ], static fn ($value) => $value !== null)
        );

        $business = Business::query()->updateOrCreate(
            ['owner_email' => 'owner@bookrahisi.test'],
            [
                'owner_first_name' => 'Amina',
                'owner_last_name' => 'Njeri',
                'business_name' => 'Urban Fade & Reset',
                'slug' => 'urban-fade-reset',
                'phone' => '+254711223344',
                'business_category' => 'Barbershop',
                'tagline' => 'Premium barbering and recovery treatments in one calm city studio.',
                'address_line' => 'Delta Corner Annex, Westlands Road',
                'city' => 'Nairobi',
                'neighborhood' => 'Westlands',
                'opening_time' => '08:30',
                'closing_time' => '20:00',
                'about' => 'Urban Fade & Reset combines precision barbering, scalp recovery, massage add-ons, and curated retail for repeat city clients.',
                'approval_status' => 'approved',
                'approved_at' => now(),
                'approval_notes' => 'Demo business approved for the POS workspace.',
            ]
        );

        $branch = Branch::query()->updateOrCreate(
            ['business_id' => $business->id, 'branch_code' => 'BR-20260511-0001'],
            [
                'name' => 'Westlands Main Branch',
                'phone' => $business->phone,
                'email' => $business->owner_email,
                'address_line' => $business->address_line,
                'city' => $business->city,
                'is_primary' => true,
                'is_active' => true,
            ]
        );

        $chair = RoomChair::query()->updateOrCreate(
            ['business_id' => $business->id, 'resource_code' => 'RSC-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'name' => 'Chair 1',
                'resource_type' => 'Chair',
                'status' => 'Active',
                'notes' => 'Main grooming chair for fades and beard work.',
            ]
        );

        $room = RoomChair::query()->updateOrCreate(
            ['business_id' => $business->id, 'resource_code' => 'RSC-20260511-0002'],
            [
                'branch_id' => $branch->id,
                'name' => 'Reset Room',
                'resource_type' => 'Room',
                'status' => 'Active',
                'notes' => 'Private room for massage and facial add-ons.',
            ]
        );

        $barber = Staff::query()->updateOrCreate(
            ['business_id' => $business->id, 'staff_code' => 'STF-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'full_name' => 'Brian Otieno',
                'role' => 'Barber',
                'phone_number' => '+254701112233',
                'email' => 'brian@bookrahisi.test',
                'commission_type' => 'Percentage',
                'commission_rate' => 12,
                'shift_schedule' => ['summary' => 'Mon-Sat / 9:00 am - 7:00 pm'],
                'can_receive_product_commission' => true,
                'status' => 'Active',
            ]
        );

        $therapist = Staff::query()->updateOrCreate(
            ['business_id' => $business->id, 'staff_code' => 'STF-20260511-0002'],
            [
                'branch_id' => $branch->id,
                'full_name' => 'Njeri Mwangi',
                'role' => 'Therapist',
                'phone_number' => '+254722334455',
                'email' => 'njeri@bookrahisi.test',
                'commission_type' => 'Percentage',
                'commission_rate' => 15,
                'shift_schedule' => ['summary' => 'Tue-Sun / 10:00 am - 8:00 pm'],
                'can_receive_product_commission' => false,
                'status' => 'Active',
            ]
        );

        Staff::query()->updateOrCreate(
            ['business_id' => $business->id, 'staff_code' => 'STF-20260511-0003'],
            [
                'branch_id' => $branch->id,
                'full_name' => 'Faith Wambui',
                'role' => 'Receptionist',
                'phone_number' => '+254733445566',
                'email' => 'faith@bookrahisi.test',
                'commission_type' => null,
                'commission_rate' => null,
                'shift_schedule' => ['summary' => 'Mon-Sat / 8:30 am - 6:00 pm'],
                'can_receive_product_commission' => false,
                'status' => 'Active',
            ]
        );

        $pomade = Product::query()->updateOrCreate(
            ['business_id' => $business->id, 'product_code' => 'PRD-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'name' => 'Matte Pomade',
                'barcode' => 'UFR001',
                'category' => 'Gel',
                'supplier' => 'Nairobi Groom Supply',
                'buying_price' => 650,
                'selling_price' => 1250,
                'current_stock' => 18,
                'reorder_level' => 6,
                'expiry_date' => now()->addMonths(10)->toDateString(),
                'vat_rate' => 16,
                'shelf_location' => 'Retail wall A1',
                'commission_enabled' => true,
                'commission_type' => 'Percentage',
                'commission_rate' => 5,
                'is_active' => true,
            ]
        );

        $scalpOil = Product::query()->updateOrCreate(
            ['business_id' => $business->id, 'product_code' => 'PRD-20260511-0002'],
            [
                'branch_id' => $branch->id,
                'name' => 'Scalp Recovery Oil',
                'barcode' => 'UFR002',
                'category' => 'Oils',
                'supplier' => 'Amani Wellness Labs',
                'buying_price' => 780,
                'selling_price' => 1600,
                'current_stock' => 4,
                'reorder_level' => 6,
                'expiry_date' => now()->addMonths(8)->toDateString(),
                'vat_rate' => 16,
                'shelf_location' => 'Treatment shelf B2',
                'commission_enabled' => false,
                'commission_type' => null,
                'commission_rate' => null,
                'is_active' => true,
            ]
        );

        Product::query()->updateOrCreate(
            ['business_id' => $business->id, 'product_code' => 'PRD-20260511-0003'],
            [
                'branch_id' => $branch->id,
                'name' => 'Hydration Shampoo',
                'barcode' => 'UFR003',
                'category' => 'Shampoo',
                'supplier' => 'Amani Wellness Labs',
                'buying_price' => 520,
                'selling_price' => 1100,
                'current_stock' => 14,
                'reorder_level' => 5,
                'expiry_date' => now()->addMonths(12)->toDateString(),
                'vat_rate' => 16,
                'shelf_location' => 'Retail wall A2',
                'commission_enabled' => false,
                'commission_type' => null,
                'commission_rate' => null,
                'is_active' => true,
            ]
        );

        $facialMask = Product::query()->updateOrCreate(
            ['business_id' => $business->id, 'product_code' => 'PRD-20260511-0004'],
            [
                'branch_id' => $branch->id,
                'name' => 'Cooling Facial Mask',
                'barcode' => 'UFR004',
                'category' => 'Skincare',
                'supplier' => 'Coast Skin House',
                'buying_price' => 400,
                'selling_price' => 950,
                'current_stock' => 11,
                'reorder_level' => 4,
                'expiry_date' => now()->addMonths(6)->toDateString(),
                'vat_rate' => 16,
                'shelf_location' => 'Spa shelf C1',
                'commission_enabled' => false,
                'commission_type' => null,
                'commission_rate' => null,
                'is_active' => true,
            ]
        );

        $signatureCut = Service::query()->updateOrCreate(
            ['business_id' => $business->id, 'service_code' => 'SRV-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'name' => 'Signature Fade & Beard',
                'category' => 'Barber',
                'price' => 1800,
                'duration_minutes' => 50,
                'commission_type' => 'Percentage',
                'commission_rate' => 12,
                'vat_applicable' => true,
                'vat_rate' => 16,
                'gender_type' => 'Male',
                'required_products' => [
                    ['product_id' => $pomade->id, 'quantity' => 0.20],
                ],
                'description' => 'Fade, beard sculpt, hot towel, and styling finish.',
                'is_active' => true,
            ]
        );

        $headMassage = Service::query()->updateOrCreate(
            ['business_id' => $business->id, 'service_code' => 'SRV-20260511-0002'],
            [
                'branch_id' => $branch->id,
                'name' => 'Scalp Recovery Massage',
                'category' => 'Massage',
                'price' => 2200,
                'duration_minutes' => 45,
                'commission_type' => 'Percentage',
                'commission_rate' => 15,
                'vat_applicable' => true,
                'vat_rate' => 16,
                'gender_type' => 'Unisex',
                'required_products' => [
                    ['product_id' => $scalpOil->id, 'quantity' => 0.35],
                ],
                'description' => 'Focused scalp, neck, and temple release with treatment oil.',
                'is_active' => true,
            ]
        );

        Service::query()->updateOrCreate(
            ['business_id' => $business->id, 'service_code' => 'SRV-20260511-0003'],
            [
                'branch_id' => $branch->id,
                'name' => 'Reset Facial Add-on',
                'category' => 'Facial',
                'price' => 1500,
                'duration_minutes' => 25,
                'commission_type' => 'Fixed',
                'commission_rate' => 250,
                'vat_applicable' => true,
                'vat_rate' => 16,
                'gender_type' => 'Unisex',
                'required_products' => [
                    ['product_id' => $facialMask->id, 'quantity' => 1],
                ],
                'description' => 'Cooling facial add-on for post-grooming recovery.',
                'is_active' => true,
            ]
        );

        $vipCustomer = Customer::query()->updateOrCreate(
            ['business_id' => $business->id, 'customer_code' => 'CUS-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'user_id' => $customerUser->id,
                'full_name' => 'Kelvin Mugo',
                'phone_number' => '+254700000011',
                'email' => 'test@example.com',
                'gender' => 'Male',
                'date_of_birth' => '1994-08-19',
                'customer_type' => 'VIP',
                'preferred_staff_id' => $barber->id,
                'visit_notes' => 'Prefers a clean mid fade and calm treatment room for massage add-ons.',
                'allergies' => 'No citrus fragrances.',
                'skin_type' => 'Combination',
                'hair_type' => 'Coarse',
                'preferred_massage_pressure' => 'Medium-firm',
                'loyalty_points' => 82,
                'last_visit_date' => now()->subDays(2)->toDateString(),
                'referral_source' => 'Instagram',
                'sms_reminder_ready' => true,
                'whatsapp_reminder_ready' => true,
            ]
        );

        Customer::query()->updateOrCreate(
            ['business_id' => $business->id, 'customer_code' => 'CUS-20260511-0002'],
            [
                'branch_id' => $branch->id,
                'full_name' => 'Achieng Atieno',
                'phone_number' => '+254712345678',
                'email' => 'achieng@bookrahisi.test',
                'gender' => 'Female',
                'date_of_birth' => '1991-03-04',
                'customer_type' => 'Regular',
                'preferred_staff_id' => $therapist->id,
                'visit_notes' => 'Usually books late afternoon massage sessions.',
                'allergies' => 'Avoid menthol products.',
                'skin_type' => 'Dry',
                'hair_type' => 'Natural',
                'preferred_massage_pressure' => 'Medium',
                'loyalty_points' => 26,
                'last_visit_date' => now()->subWeek()->toDateString(),
                'referral_source' => 'Friend referral',
                'sms_reminder_ready' => true,
                'whatsapp_reminder_ready' => true,
            ]
        );

        Membership::query()->updateOrCreate(
            ['business_id' => $business->id, 'customer_id' => $vipCustomer->id],
            [
                'membership_number' => 'MEM-20260511-0001',
                'membership_type' => 'Gold',
                'points_earned' => 140,
                'points_redeemed' => 58,
                'reward_balance' => 82,
                'membership_expiry_date' => now()->addMonths(10)->toDateString(),
                'is_active' => true,
            ]
        );

        $appointment = Appointment::query()->updateOrCreate(
            ['business_id' => $business->id, 'appointment_number' => 'BKG-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'customer_id' => $vipCustomer->id,
                'service_id' => $headMassage->id,
                'staff_id' => $therapist->id,
                'room_chair_id' => $room->id,
                'booking_date' => now()->addDay()->toDateString(),
                'start_time' => '14:00:00',
                'end_time' => '14:45:00',
                'duration_minutes' => 45,
                'status' => 'Confirmed',
                'notes' => 'VIP loyalty follow-up session.',
                'reminder_sent' => true,
                'reminder_sent_at' => now(),
            ]
        );

        $sale = Sale::query()->updateOrCreate(
            ['business_id' => $business->id, 'receipt_number' => 'RCPT-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'appointment_id' => $appointment->id,
                'customer_id' => $vipCustomer->id,
                'staff_id' => $barber->id,
                'transaction_date' => now()->subHours(3),
                'subtotal' => 3050,
                'discount_amount' => 100,
                'vat_amount' => 472,
                'total_amount' => 3422,
                'payment_method' => 'Split Payment',
                'amount_paid' => 3422,
                'balance_amount' => 0,
                'sales_channel' => 'Appointment',
                'loyalty_points_earned' => 36,
                'loyalty_points_redeemed' => 20,
                'currency' => 'KES',
                'notes' => 'Demo receipt for POS preview.',
                'closed_at' => now()->subHours(2),
            ]
        );

        $serviceItem = SaleItem::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'description' => 'Signature Fade & Beard'],
            [
                'business_id' => $business->id,
                'service_id' => $signatureCut->id,
                'product_id' => null,
                'staff_id' => $barber->id,
                'item_type' => 'service',
                'quantity' => 1,
                'unit_price' => 1800,
                'line_subtotal' => 1800,
                'discount_amount' => 50,
                'vat_rate' => 16,
                'vat_amount' => 280,
                'line_total' => 2030,
                'commission_type' => 'Percentage',
                'commission_rate' => 12,
                'commission_amount' => 210,
                'metadata' => ['deduct_products' => true],
            ]
        );

        $productItem = SaleItem::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'description' => 'Matte Pomade'],
            [
                'business_id' => $business->id,
                'service_id' => null,
                'product_id' => $pomade->id,
                'staff_id' => $barber->id,
                'item_type' => 'product',
                'quantity' => 1,
                'unit_price' => 1250,
                'line_subtotal' => 1250,
                'discount_amount' => 50,
                'vat_rate' => 16,
                'vat_amount' => 192,
                'line_total' => 1392,
                'commission_type' => 'Percentage',
                'commission_rate' => 5,
                'commission_amount' => 60,
                'metadata' => [],
            ]
        );

        $cashPayment = Payment::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'payment_method' => 'Cash'],
            [
                'business_id' => $business->id,
                'customer_id' => $vipCustomer->id,
                'amount' => 422,
                'status' => 'Paid',
                'reference' => 'Counter cash',
                'paid_at' => now()->subHours(3),
                'metadata' => ['notes' => 'Cash top-up after loyalty redemption.'],
                'notes' => 'Cash top-up after loyalty redemption.',
            ]
        );

        $mpesaPayment = Payment::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'payment_method' => 'M-Pesa'],
            [
                'business_id' => $business->id,
                'customer_id' => $vipCustomer->id,
                'amount' => 3000,
                'status' => 'Paid',
                'reference' => 'SE2K7H98TQ',
                'paid_at' => now()->subHours(3),
                'metadata' => ['notes' => 'Customer settled by till.'],
                'notes' => 'Customer settled by till.',
            ]
        );

        MpesaTransaction::query()->updateOrCreate(
            ['mpesa_code' => 'SE2K7H98TQ'],
            [
                'business_id' => $business->id,
                'sale_id' => $sale->id,
                'payment_id' => $mpesaPayment->id,
                'phone_number' => $vipCustomer->phone_number,
                'till_or_paybill' => 'Till 543210',
                'payment_status' => 'Paid',
                'transaction_time' => now()->subHours(3),
                'linked_receipt_number' => $sale->receipt_number,
            ]
        );

        Commission::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'sale_item_id' => $serviceItem->id, 'staff_id' => $barber->id],
            [
                'business_id' => $business->id,
                'source_type' => 'service',
                'commission_type' => 'Percentage',
                'commission_rate' => 12,
                'eligible_amount' => 1750,
                'commission_amount' => 210,
                'commission_date' => now()->toDateString(),
                'notes' => 'Service commission for signature cut.',
            ]
        );

        Commission::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'sale_item_id' => $productItem->id, 'staff_id' => $barber->id],
            [
                'business_id' => $business->id,
                'source_type' => 'product',
                'commission_type' => 'Percentage',
                'commission_rate' => 5,
                'eligible_amount' => 1200,
                'commission_amount' => 60,
                'commission_date' => now()->toDateString(),
                'notes' => 'Retail commission for pomade.',
            ]
        );

        LoyaltyPoint::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'customer_id' => $vipCustomer->id],
            [
                'business_id' => $business->id,
                'points_earned' => 36,
                'points_redeemed' => 20,
                'balance_after' => 82,
                'description' => 'Sale '.$sale->receipt_number,
                'recorded_at' => now()->subHours(2),
            ]
        );

        InventoryLog::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'product_id' => $pomade->id, 'reason' => 'sale'],
            [
                'business_id' => $business->id,
                'branch_id' => $branch->id,
                'appointment_id' => $appointment->id,
                'quantity_change' => -1,
                'stock_before' => 19,
                'stock_after' => 18,
                'notes' => $sale->receipt_number,
                'logged_at' => now()->subHours(3),
            ]
        );

        InventoryLog::query()->updateOrCreate(
            ['sale_id' => $sale->id, 'product_id' => $scalpOil->id, 'reason' => 'service_use'],
            [
                'business_id' => $business->id,
                'branch_id' => $branch->id,
                'appointment_id' => $appointment->id,
                'quantity_change' => -0.35,
                'stock_before' => 4.35,
                'stock_after' => 4,
                'notes' => $sale->receipt_number,
                'logged_at' => now()->subHours(3),
            ]
        );

        Expense::query()->updateOrCreate(
            ['business_id' => $business->id, 'expense_code' => 'EXP-20260511-0001'],
            [
                'branch_id' => $branch->id,
                'expense_category' => 'Supplies',
                'amount' => 8500,
                'vendor' => 'Nairobi Groom Supply',
                'payment_method' => 'Bank Transfer',
                'expense_date' => now()->subDay()->toDateString(),
                'notes' => 'Retail and treatment stock top-up.',
            ]
        );
    }
}
