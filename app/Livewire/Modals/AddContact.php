<?php

namespace App\Livewire\Modals;

use Livewire\Component;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Flux\Flux;

class AddContact extends Component
{
    public ContactForm $form;

    public function store()
    {
        $this->form->validate();

        $contact = Contact::create($this->form->all());
        $contact->logActivity('Contact created');

        $this->form->reset();

        Flux::modal('add-contact-modal')->close();

        $this->dispatch('contact-added');
        $this->dispatch('toast', message: 'Contact created successfully', type: 'success');
    }

    public function render()
    {
        return view('livewire.modals.add-contact');
    }
}
