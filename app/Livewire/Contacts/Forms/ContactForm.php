<?php

namespace App\Livewire\Contacts\Forms;

use Livewire\Form;

class ContactForm extends Form
{
    public ?int $id = null;

    public string $first_name = '';

    public string $last_name = '';

    public string $email = '';

    public string $phone = '';

    public string $address = '';

    public string $landmark = '';

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|max:255',
            'last_name' => 'nullable|string|max:255',
            'email' => 'nullable|email|unique:contacts,email'.($this->id ? ",$this->id" : ''),
            'phone' => ['nullable', 'regex:/^\+[1-9]\d{1,14}$/'],
            'address' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid phone number in E.164 format (e.g., +923001234567).',
        ];
    }
}
