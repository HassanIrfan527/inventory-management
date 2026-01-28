<?php

namespace App\Livewire\Modals;

use App\Livewire\Forms\ContactForm;
use App\Services\ContactService;
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

        $contactService = app(ContactService::class);
        $contactService->createContact($data);

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
