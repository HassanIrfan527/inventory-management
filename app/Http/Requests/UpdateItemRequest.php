<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['sometimes', 'required', 'string', 'min:5'],
            'description' => ['sometimes', 'required', 'string', 'min:5'],
            'cost_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'retail_price' => ['sometimes', 'required', 'numeric', 'min:0'],
            'delivery_charges' => ['sometimes', 'required', 'numeric', 'min:0'],
            'product_images' => ['nullable', 'array'],
            'product_images.*' => ['image', 'max:10240'],
            'categories' => ['nullable', 'array'],
            'categories.*' => ['integer', 'exists:categories,id'],
        ];
    }
}
