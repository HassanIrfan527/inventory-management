<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ContactForm;
use App\Models\Contact;
use Flux\Flux;
use Livewire\Component;

class AddContact extends Component
{
    public ContactForm $form;

    public function store()
    {
        $this->form->validate();

        $data = $this->form->all();
        unset($data['id']);

        $contact = Contact::create($data);
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
