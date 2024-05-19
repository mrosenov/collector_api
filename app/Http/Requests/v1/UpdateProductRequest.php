<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'description' => ['string'],
            'price' => ['integer'],
            'taxRate' => ['decimal:2', 'min:0', 'max:100'],
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->taxRate) {
            $this->merge(['tax_rate' => $this->taxRate]);
        }
    }
}
