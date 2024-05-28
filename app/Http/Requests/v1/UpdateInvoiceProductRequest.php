<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class UpdateInvoiceProductRequest extends FormRequest
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
            'invoiceId' => ['integer','exists:invoices,id'],
            'productId' => ['integer','exists:products,id'],
            'quantity' => ['integer','min:1'],
            'price' => ['integer','min:0'],
            'taxRate' => ['numeric', 'min:0', 'max:100'],
        ];
    }

    protected function prepareForValidation()
    {
        foreach ($this->all() as $key => $value) {
            $transformKey = Str::snake($key);

            $this->merge([
                $transformKey => $value
            ]);
        }
    }
}
