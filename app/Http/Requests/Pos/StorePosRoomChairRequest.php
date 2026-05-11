<?php

namespace App\Http\Requests\Pos;

use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosRoomChairRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'name' => ['required', 'string', 'max:120'],
            'resource_type' => ['required', Rule::in(PosOptions::resourceTypes())],
            'status' => ['required', Rule::in(PosOptions::statuses())],
            'notes' => ['nullable', 'string'],
        ];
    }
}
