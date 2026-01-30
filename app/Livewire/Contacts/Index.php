<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Component;

class Index extends Component
{
    public string $search = '';

    public string $sortBy = 'name';

    protected $listeners = ['contact-added' => '$refresh'];

    protected $queryString = [
        'search' => ['except' => ''],
        'sortBy' => ['except' => 'name'],
    ];

    public function deleteContact(int $id): void
    {
        $contact = Contact::find($id);

        if (! $contact) {
            return;
        }

        $contactService = app(ContactService::class);
        $contactService->deleteContact($contact);

        \Flux\Flux::modal("delete-contact-{$id}")->close();
        $this->reset();
        $this->dispatch('toast', message: 'Contact deleted successfully', type: 'success');
    }

    #[\Livewire\Attributes\Computed]
    public function contacts(ContactService $contactService)
    {
        return $contactService->listContacts(
            search: $this->search,
            sortBy: $this->sortBy,
            perPage: 100 // Using a large number to match previous get() behavior or I can update to pagination later
        )->getCollection();
    }

    public function render()
    {
        return view('livewire.contacts.index');
    }
}
