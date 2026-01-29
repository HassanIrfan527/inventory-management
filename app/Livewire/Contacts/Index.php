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
    public function contacts()
    {
        return Contact::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('name', 'like', '%'.$this->search.'%')
                        ->orWhere('email', 'like', '%'.$this->search.'%');
                });
            })
            ->when($this->sortBy === 'name', fn ($q) => $q->orderBy('name'))
            ->when($this->sortBy === 'created_at', fn ($q) => $q->latest())
            ->when($this->sortBy === 'updated_at', fn ($q) => $q->latest('updated_at'))
            ->get();
    }

    public function render()
    {
        return view('livewire.contacts.index');
    }
}
