<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateInvoiceRequest extends FormRequest
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
            'customerId' => ['integer', 'exists:customers,id'],
            'total' => ['integer', 'min:1'],
            'status' => ['string', Rule::in(['billed','paid','void'])],
            'billedDate' => ['date', 'date_format:Y-m-d H:i:s'],
            'paidDate' => ['date', 'date_format:Y-m-d H:i:s', 'required_if:status,paid'],
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
