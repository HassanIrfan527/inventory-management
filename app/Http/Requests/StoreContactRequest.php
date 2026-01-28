<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:contacts,email'],
            'phone' => ['nullable', 'regex:/^\d{4}-\d{7}$/'],
            'whatsapp_no' => ['nullable', 'regex:/^\d{4}-\d{7}$/'],
            'address' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid format (03xx-xxxxxxx).',
            'whatsapp_no.regex' => 'Please enter a valid format (03xx-xxxxxxx).',
        ];
    }
}
