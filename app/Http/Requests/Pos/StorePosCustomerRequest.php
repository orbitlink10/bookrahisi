<?php

namespace App\Http\Requests\Pos;

use App\Services\Pos\KenyaPhoneNumber;
use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosCustomerRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'phone_number' => KenyaPhoneNumber::normalize($this->input('phone_number')),
            'loyalty_points' => $this->input('loyalty_points', 0),
            'sms_reminder_ready' => $this->boolean('sms_reminder_ready'),
            'whatsapp_reminder_ready' => $this->boolean('whatsapp_reminder_ready'),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'full_name' => ['required', 'string', 'max:120'],
            'phone_number' => ['required', 'string', 'max:30', 'regex:'.PosOptions::kenyanPhonePattern()],
            'email' => ['nullable', 'email', 'max:255'],
            'gender' => ['nullable', Rule::in(PosOptions::customerGenders())],
            'date_of_birth' => ['nullable', 'date'],
            'customer_type' => ['required', Rule::in(PosOptions::customerTypes())],
            'preferred_staff_id' => ['nullable', 'integer', 'exists:staff,id'],
            'visit_notes' => ['nullable', 'string'],
            'allergies' => ['nullable', 'string'],
            'skin_type' => ['nullable', 'string', 'max:60'],
            'hair_type' => ['nullable', 'string', 'max:60'],
            'preferred_massage_pressure' => ['nullable', 'string', 'max:60'],
            'loyalty_points' => ['nullable', 'integer', 'min:0'],
            'last_visit_date' => ['nullable', 'date'],
            'referral_source' => ['nullable', 'string', 'max:120'],
            'sms_reminder_ready' => ['nullable', 'boolean'],
            'whatsapp_reminder_ready' => ['nullable', 'boolean'],
        ];
    }
}
