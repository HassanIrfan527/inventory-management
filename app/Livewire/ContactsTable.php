<?php

namespace App\Livewire;

use App\Models\Contact;
use Livewire\Component;

class ContactsTable extends Component
{
    public $contacts;

    public function mount()
    {
        $this->contacts = Contact::all();
    }
    public function render()
    {
        return view('livewire.contacts-table');
    }
}
