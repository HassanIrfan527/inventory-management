<?php

namespace App\Livewire\Forms;

use Livewire\Form;

class ContactForm extends Form
{
    public ?int $id = null;

    public string $name = '';

    public string $email = '';

    public string $phone = '';

    public string $whatsapp_no = '';

    public string $address = '';

    public string $landmark = '';

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:contacts,email'.($this->id ? ",$this->id" : ''),
            'phone' => ['nullable', 'regex:/^\d{4}-\d{7}$/'],
            'whatsapp_no' => ['nullable', 'regex:/^\d{4}-\d{7}$/'],
            'address' => 'nullable|string|max:255',
            'landmark' => 'nullable|string|max:255',
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
