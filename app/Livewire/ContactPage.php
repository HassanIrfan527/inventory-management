<?php

namespace App\Livewire;

use App\Models\Contact;
use App\Services\ContactService;
use Illuminate\Support\Str;
use Livewire\Component;

class ContactPage extends Component
{
    public Contact $contact;

    public ?bool $edit = false;

    public ?string $phone = null;

    public ?string $whatsapp_no = null;

    public ?string $address = null;

    public ?string $landmark = null;

    public string $note = '';

    protected $queryString = ['edit'];

    protected $rules = [
        // Validates the format with the dash as it comes from the input
        'phone' => ['required', 'regex:/^\d{4}-\d{7}$/'],

    ];

    public function messages()
    {
        return [
            'phone.regex' => 'Please enter a valid 11-digit number (03xx-xxxxxxx).',
        ];
    }

    public function mount(Contact $contact, $edit = null)
    {
        $this->contact = $contact;
        $this->edit = $edit;
        // $this->phone = $contact->phone;
        $this->phone = $contact->phone;
        $this->whatsapp_no = $contact->whatsapp_no;
        $this->address = $contact->address;
        $this->landmark = $contact->landmark;
    }

    public function updated($property, $value): void
    {
        $this->validateOnly($property);
        // Persist updates from primitive properties to the Contact model
        if (str_starts_with($property, 'contact.')) {
            $field = Str::after($property, 'contact.');
            $this->contact->update([$field => $value]);
            $this->dispatch('toast', message: 'Contact updated successfully', type: 'success');

            return;
        }

        $fields = ['phone', 'whatsapp_no', 'address', 'landmark'];
        if (in_array($property, $fields, true)) {
            $this->contact->update([$property => $value]);
            $this->contact->logActivity("Updated $property to $value");
            $this->dispatch('toast', message: 'Contact updated successfully', type: 'success');
        }
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
        return view('livewire.contact-page');
    }
}
