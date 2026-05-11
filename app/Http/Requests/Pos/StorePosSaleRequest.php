<?php

namespace App\Http\Requests\Pos;

use App\Models\MpesaTransaction;
use App\Services\Pos\KenyaPhoneNumber;
use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Validator;

class StorePosSaleRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $serviceItems = array_values(array_filter($this->input('service_items', []), fn (array $row): bool => ! empty($row['service_id'] ?? null)));
        $productItems = array_values(array_filter($this->input('product_items', []), fn (array $row): bool => ! empty($row['product_id'] ?? null)));
        $packageItems = array_values(array_filter($this->input('package_items', []), fn (array $row): bool => filled($row['name'] ?? null)));
        $payments = array_map(function (array $row): array {
            if (($row['payment_method'] ?? null) === 'M-Pesa') {
                $row['phone_number'] = KenyaPhoneNumber::normalize($row['phone_number'] ?? null);
            }

            return $row;
        }, array_values(array_filter($this->input('payments', []), fn (array $row): bool => (float) ($row['amount'] ?? 0) > 0)));

        $this->merge([
            'service_items' => $serviceItems,
            'product_items' => $productItems,
            'package_items' => $packageItems,
            'payments' => $payments,
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'appointment_id' => ['nullable', 'integer', 'exists:appointments,id'],
            'customer_id' => ['nullable', 'integer', 'exists:customers,id'],
            'staff_id' => ['nullable', 'integer', 'exists:staff,id'],
            'transaction_date' => ['required', 'date'],
            'sales_channel' => ['required', Rule::in(PosOptions::salesChannels())],
            'discount_amount' => ['nullable', 'numeric', 'min:0'],
            'loyalty_points_to_redeem' => ['nullable', 'integer', 'min:0'],
            'notes' => ['nullable', 'string'],
            'service_items' => ['nullable', 'array'],
            'service_items.*.service_id' => ['required', 'integer', 'exists:services,id'],
            'service_items.*.staff_id' => ['nullable', 'integer', 'exists:staff,id'],
            'service_items.*.quantity' => ['required', 'numeric', 'min:1'],
            'service_items.*.discount_amount' => ['nullable', 'numeric', 'min:0'],
            'service_items.*.deduct_products' => ['nullable', 'boolean'],
            'product_items' => ['nullable', 'array'],
            'product_items.*.product_id' => ['required', 'integer', 'exists:products,id'],
            'product_items.*.staff_id' => ['nullable', 'integer', 'exists:staff,id'],
            'product_items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'product_items.*.discount_amount' => ['nullable', 'numeric', 'min:0'],
            'package_items' => ['nullable', 'array'],
            'package_items.*.name' => ['required', 'string', 'max:120'],
            'package_items.*.staff_id' => ['nullable', 'integer', 'exists:staff,id'],
            'package_items.*.quantity' => ['required', 'numeric', 'min:1'],
            'package_items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'package_items.*.discount_amount' => ['nullable', 'numeric', 'min:0'],
            'payments' => ['required', 'array', 'min:1'],
            'payments.*.payment_method' => ['required', Rule::in(PosOptions::settlementMethods())],
            'payments.*.amount' => ['required', 'numeric', 'min:0.01'],
            'payments.*.status' => ['required', Rule::in(PosOptions::paymentStatuses())],
            'payments.*.reference' => ['nullable', 'string', 'max:120'],
            'payments.*.paid_at' => ['nullable', 'date'],
            'payments.*.notes' => ['nullable', 'string', 'max:300'],
            'payments.*.mpesa_code' => ['nullable', 'string', 'max:60'],
            'payments.*.phone_number' => ['nullable', 'string', 'max:30'],
            'payments.*.till_or_paybill' => ['nullable', 'string', 'max:60'],
        ];
    }

    public function withValidator(Validator $validator): void
    {
        $validator->after(function (Validator $validator): void {
            $mpesaCodes = [];

            if (
                count($this->input('service_items', [])) === 0
                && count($this->input('product_items', [])) === 0
                && count($this->input('package_items', [])) === 0
            ) {
                $validator->errors()->add('service_items', 'Add at least one service, product, or package.');
            }

            foreach ($this->input('payments', []) as $index => $payment) {
                if (($payment['payment_method'] ?? null) !== 'M-Pesa') {
                    continue;
                }

                if (blank($payment['mpesa_code'] ?? null)) {
                    $validator->errors()->add("payments.$index.mpesa_code", 'M-Pesa code is required for M-Pesa payments.');
                } else {
                    $code = (string) $payment['mpesa_code'];

                    if (in_array($code, $mpesaCodes, true)) {
                        $validator->errors()->add("payments.$index.mpesa_code", 'Each M-Pesa code can only be used once per sale.');
                    } else {
                        $mpesaCodes[] = $code;
                    }
                }

                if (blank($payment['phone_number'] ?? null) || ! preg_match(PosOptions::kenyanPhonePattern(), (string) $payment['phone_number'])) {
                    $validator->errors()->add("payments.$index.phone_number", 'Use a valid Kenyan phone number for M-Pesa payments.');
                }

                if (blank($payment['till_or_paybill'] ?? null)) {
                    $validator->errors()->add("payments.$index.till_or_paybill", 'Till or Paybill is required for M-Pesa payments.');
                }
            }

            if ($mpesaCodes === []) {
                return;
            }

            $existingCodes = MpesaTransaction::query()
                ->whereIn('mpesa_code', $mpesaCodes)
                ->pluck('mpesa_code')
                ->all();

            foreach ($this->input('payments', []) as $index => $payment) {
                if (($payment['payment_method'] ?? null) !== 'M-Pesa') {
                    continue;
                }

                $code = (string) ($payment['mpesa_code'] ?? '');

                if ($code !== '' && in_array($code, $existingCodes, true)) {
                    $validator->errors()->add("payments.$index.mpesa_code", 'That M-Pesa code has already been recorded.');
                }
            }
        });
    }
}
