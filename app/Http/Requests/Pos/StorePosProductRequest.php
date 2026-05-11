<?php

namespace App\Http\Requests\Pos;

use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosProductRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'commission_enabled' => $this->boolean('commission_enabled'),
            'is_active' => $this->boolean('is_active'),
        ]);
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'name' => ['required', 'string', 'max:120'],
            'barcode' => ['nullable', 'string', 'max:80'],
            'category' => ['required', Rule::in(PosOptions::productCategories())],
            'supplier' => ['nullable', 'string', 'max:120'],
            'buying_price' => ['required', 'numeric', 'min:0'],
            'selling_price' => ['required', 'numeric', 'min:0'],
            'current_stock' => ['required', 'numeric', 'min:0'],
            'reorder_level' => ['required', 'numeric', 'min:0'],
            'expiry_date' => ['nullable', 'date'],
            'vat_rate' => ['required', 'numeric', 'min:0', 'max:100'],
            'shelf_location' => ['nullable', 'string', 'max:80'],
            'commission_enabled' => ['nullable', 'boolean'],
            'commission_type' => ['nullable', Rule::in(PosOptions::commissionTypes())],
            'commission_rate' => ['nullable', 'numeric', 'min:0'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
