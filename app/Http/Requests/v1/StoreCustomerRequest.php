<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCustomerRequest extends FormRequest
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
            'name' => ['required'],
            'type' => ['required', Rule::in(['person','company','Person','Company'])],
            'phone' => ['required'],
            'email' => ['required','email'],
            'address' => ['required'],
            'city' => ['required'],
            'postCode' => ['required'],
            'country' => ['required']
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge(['postcode' => $this->postCode]);
    }
}