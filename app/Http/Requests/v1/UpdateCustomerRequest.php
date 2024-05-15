<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerRequest extends FormRequest
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
        if ($this->method() == 'PUT') {
            return [
                'type' => [Rule::in(['person', 'company', 'Person', 'Company'])],
                'email' => ['email'],
            ];
        }
        else {
            return [
                'type' => [Rule::in(['person', 'company', 'Person', 'Company'])],
                'email' => ['email'],
            ];
        }
    }

    protected function prepareForValidation()
    {
        if ($this->postCode) {
            $this->merge([
                'postCode' => $this->postCode
            ]);
        }
    }
}
