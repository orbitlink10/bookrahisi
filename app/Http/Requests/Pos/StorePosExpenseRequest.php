<?php

namespace App\Http\Requests\Pos;

use App\Support\PosOptions;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePosExpenseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'branch_id' => ['nullable', 'integer', 'exists:branches,id'],
            'expense_category' => ['required', Rule::in(PosOptions::expenseCategories())],
            'amount' => ['required', 'numeric', 'min:0'],
            'vendor' => ['nullable', 'string', 'max:120'],
            'payment_method' => ['required', Rule::in(PosOptions::settlementMethods())],
            'expense_date' => ['required', 'date'],
            'notes' => ['nullable', 'string'],
        ];
    }
}
