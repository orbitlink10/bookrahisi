<?php

namespace App\Http\Requests\Pos;

use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosAppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'reminder_sent' => $this->boolean('reminder_sent'),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'customer_id' => ['required', 'integer', 'exists:customers,id'],
            'service_id' => ['required', 'integer', 'exists:services,id'],
            'staff_id' => ['required', 'integer', 'exists:staff,id'],
            'room_chair_id' => ['nullable', 'integer', 'exists:rooms_chairs,id'],
            'booking_date' => ['required', 'date'],
            'start_time' => ['required', 'date_format:H:i'],
            'duration_minutes' => ['nullable', 'integer', 'min:5', 'max:720'],
            'status' => ['required', Rule::in(PosOptions::bookingStatuses())],
            'notes' => ['nullable', 'string'],
            'reminder_sent' => ['nullable', 'boolean'],
        ];
    }
}
