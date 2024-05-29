<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StorePaymentRequest extends FormRequest
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
            'invoiceId' => ['required', 'integer', 'exists:invoices,id'],
            'refId' => ['string', 'unique:payments,ref_id'],
            'amount' => ['required', 'integer', 'min:0'],
            'paymentDate' => ['required', 'date', 'date_format:Y-m-d H:i:s'],
            'paymentMethod' => ['required', 'integer', 'exists:payment_methods,id'],
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
