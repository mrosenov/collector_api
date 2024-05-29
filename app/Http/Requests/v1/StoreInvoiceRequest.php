<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class StoreInvoiceRequest extends FormRequest
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
            'customerId' => ['required', 'integer', 'exists:customers,id'],
            'total' => ['required', 'integer', 'min:1'],
            'status' => ['required', 'string', Rule::in(['billed','paid','void'])],
            'billedDate' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'paidDate' => ['date', 'date_format:Y-m-d H:i:s', 'required_if:status,paid'],
            'products' => ['required', 'array'],
            'products.*.invoiceId' => ['integer', 'exists:invoices,id'],
            'products.*.productId' => ['integer', 'exists:products,id'],
            'products.*.quantity' => ['required', 'integer', 'min:1'],
            'products.*.price' => ['required', 'integer', 'min:0'],
            'products.*.taxRate' => ['required', 'numeric', 'min:0', 'max:100'],
        ];
    }

    protected function prepareForValidation()
    {
        foreach ($this->all() as $key => $value) {
            $transformKey = Str::snake($key);
            if (strpos($transformKey, 'products') === 0) {
                $nestedKeys = explode('.', $key);
                $firstPart = array_shift($nestedKeys);
                $transformKey = $firstPart . '.' . implode('.*', $nestedKeys);
            }

            $this->merge([
                $transformKey => $value
            ]);
        }
    }
}
