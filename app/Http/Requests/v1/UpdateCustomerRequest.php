<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
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
        return [
            'type' => [Rule::in(['person', 'company'])],
            'vat' => ['required_if:type,company'],
            'email' => ['email'],
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
