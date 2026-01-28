<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $contactId = $this->route('contact')?->id;

        return [
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'email' => [
                'sometimes',
                'nullable',
                'email',
                Rule::unique('contacts', 'email')->ignore($contactId),
            ],
            'phone' => ['sometimes', 'nullable', 'regex:/^\d{4}-\d{7}$/'],
            'whatsapp_no' => ['sometimes', 'nullable', 'regex:/^\d{4}-\d{7}$/'],
            'address' => ['sometimes', 'nullable', 'string', 'max:255'],
            'landmark' => ['sometimes', 'nullable', 'string', 'max:255'],
        ];
    }
}
