<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RuleFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'buy_quantity' => 'nullable|integer',
            'get_quantity' => 'nullable|integer',
            'minimum_quantity' => 'nullable|integer',
            'promotion_price' => 'nullable|integer',
            'discount_percentage' => 'nullable|integer',
        ];
    }
}
