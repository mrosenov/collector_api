<?php

namespace App\Http\Requests\v1;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;

class StoreProductRequest extends FormRequest
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
            'description' => ['string', 'nullable'],
            'price' => ['required', 'integer'],
            'taxRate' => ['required', 'decimal:2', 'min:0', 'max:100'],
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
