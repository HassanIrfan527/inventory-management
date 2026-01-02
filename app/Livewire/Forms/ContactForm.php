<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Validate;
use Livewire\Form;

class ContactForm extends Form
{
    #[Validate('required|string|max:255')]
    public string $name = '';

    #[Validate('nullable|email|unique:contacts,email')]
    public string $email = '';

    #[Validate(['nullable', 'regex:/^\d{4}-\d{7}$/'], message: [
        'regex' => 'Please enter a valid format (03xx-xxxxxxx).',
    ])]
    public string $phone = '';

    #[Validate(['nullable', 'regex:/^\d{4}-\d{7}$/'], message: [
        'regex' => 'Please enter a valid format (03xx-xxxxxxx).',
    ])]
    public string $whatsapp_no = '';

    #[Validate('nullable|string|max:255')]
    public string $address = '';

    #[Validate('nullable|string|max:255')]
    public string $landmark = '';
}
