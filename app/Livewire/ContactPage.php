<?php

namespace App\Livewire;

use App\Models\Contact;
use Illuminate\Support\Str;
use Livewire\Attributes\Validate;
use Livewire\Component;

class ContactPage extends Component
{
    public Contact $contact;

    public ?bool $edit = false;

    public ?string $phone = null;
    public ?string $whatsapp_no = null;
    public ?string $address = null;
    public ?string $landmark = null;

    protected $queryString = ['edit'];

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
            $this->dispatch('toast', message: 'Contact updated successfully', type: 'success');
        }
    }
    public function render()
    {
        return view('livewire.contact-page');
    }
}
