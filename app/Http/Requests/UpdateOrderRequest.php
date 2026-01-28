<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateOrderRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'status' => ['sometimes', 'required', 'in:Pending,Processing,Completed'],
            'delivery_charge' => ['sometimes', 'nullable', 'integer', 'min:0'],
            'address' => ['sometimes', 'nullable', 'string'],
        ];
    }
}
