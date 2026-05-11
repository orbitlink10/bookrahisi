<?php

namespace App\Http\Requests\Pos;

use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosServiceRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'vat_applicable' => $this->boolean('vat_applicable'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'name' => ['required', 'string', 'max:120'],
            'category' => ['required', Rule::in(PosOptions::serviceCategories())],
            'price' => ['required', 'numeric', 'min:0'],
            'duration_minutes' => ['required', 'integer', 'min:5', 'max:720'],
            'commission_type' => ['nullable', Rule::in(PosOptions::commissionTypes())],
            'commission_rate' => ['nullable', 'numeric', 'min:0'],
            'vat_applicable' => ['nullable', 'boolean'],
            'vat_rate' => ['nullable', 'numeric', 'min:0', 'max:100'],
            'gender_type' => ['required', Rule::in(PosOptions::serviceGenderTypes())],
            'required_product_id' => ['nullable', 'integer', 'exists:products,id'],
            'required_product_quantity' => ['nullable', 'numeric', 'min:0.01'],
            'description' => ['nullable', 'string'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
