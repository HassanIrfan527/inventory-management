<?php

namespace App\Livewire\Contacts;

use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Contact $contact;

    public ?bool $edit = false;

    public ?string $phone = null;

    public ?string $address = null;

    public ?string $landmark = null;

    public string $note = '';

    protected $queryString = ['edit'];

    protected $rules = [
        'phone' => ['required', 'regex:/^\+?[0-9\s\-()]+$/'],
    ];

    public function messages()
    {
        return [
            'phone.regex' => 'Please enter a valid phone number.',
        ];
    }

    public function mount(Contact $contact, $edit = null)
    {
        $this->contact = $contact;
        $this->edit = $edit;
        $this->phone = $contact->phone;
        $this->address = $contact->address;
        $this->landmark = $contact->landmark;
    }

    public function save(ContactService $contactService): void
    {
        $this->validate();

        $contactService->updateContact($this->contact, [
            'phone' => $this->phone,
            'address' => $this->address,
            'landmark' => $this->landmark,
        ]);

        $this->edit = false;
        $this->dispatch('toast', message: 'Contact updated successfully', type: 'success');
    }

    public function cancel(): void
    {
        $this->edit = false;
        $this->phone = $this->contact->phone;
        $this->address = $this->contact->address;
        $this->landmark = $this->contact->landmark;
    }

    public function addNote(): void
    {
        $this->validate(['note' => 'required|string|min:3']);

        $this->contact->logActivity('Note added', null, ['content' => $this->note]);

        $this->note = '';
        $this->dispatch('toast', message: 'Note added successfully', type: 'success');
    }

    #[\Livewire\Attributes\Computed]
    public function activities()
    {
        return $this->contact->activities()->with('subject')->latest()->get();
    }

    public function deleteContact($id = null): void
    {
        $contactService = app(ContactService::class);
        $contactService->deleteContact($this->contact);

        \Flux\Flux::modal('delete-modal')->close();
        $this->dispatch('toast', message: 'Contact deleted successfully', type: 'success');
        $this->redirect(route('contacts.all'), navigate: true);
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
