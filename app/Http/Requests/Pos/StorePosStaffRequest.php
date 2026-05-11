<?php

namespace App\Http\Requests\Pos;

use App\Services\Pos\KenyaPhoneNumber;
use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosStaffRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone_number' => KenyaPhoneNumber::normalize($this->input('phone_number')),
            'can_receive_product_commission' => $this->boolean('can_receive_product_commission'),
            'status' => $this->input('status', 'Active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'full_name' => ['required', 'string', 'max:120'],
            'role' => ['required', Rule::in(PosOptions::staffRoles())],
            'phone_number' => ['required', 'string', 'max:30', 'regex:'.PosOptions::kenyanPhonePattern()],
            'email' => ['nullable', 'email', 'max:255'],
            'commission_type' => ['nullable', Rule::in(PosOptions::commissionTypes())],
            'commission_rate' => ['nullable', 'numeric', 'min:0'],
            'shift_schedule' => ['nullable', 'string', 'max:200'],
            'can_receive_product_commission' => ['nullable', 'boolean'],
            'status' => ['required', Rule::in(PosOptions::statuses())],
        ];
    }
}
