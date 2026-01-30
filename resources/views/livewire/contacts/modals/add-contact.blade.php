<?php

use App\Livewire\Contacts\Forms\ContactForm;
use App\Services\ContactService;
use Flux\Flux;
use Livewire\Component;

new class extends Component
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
};
?>

<flux:modal name="add-contact-modal" flyout variant="floating" class="space-y-6">
    <div>
        <flux:heading size="lg">Add Contact</flux:heading>
        <flux:subheading>Add a new contact to your list.</flux:subheading>
    </div>

    <flux:separator variant="subtle" />

    <form class="space-y-6" wire:submit.prevent="store">
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <flux:field>
                <flux:label badge="Required">First Name</flux:label>
                <flux:input placeholder="John" wire:model="form.first_name" icon="user" autofocus />
            </flux:field>

            <flux:field>
                <flux:label badge="Optional">Last Name</flux:label>
                <flux:input placeholder="Doe" wire:model="form.last_name" icon="user" />
            </flux:field>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
            <flux:field>
                <flux:label badge="Optional">Email</flux:label>
                <flux:input type="email" placeholder="john@example.com" wire:model="form.email" icon="envelope" />
            </flux:field>

            <flux:field>
                <flux:label badge="Optional">Phone</flux:label>
                <flux:input placeholder="+1 234 567 890" wire:model="form.phone" icon="phone" />
            </flux:field>
        </div>

        <flux:field>
            <flux:label badge="Optional">Address</flux:label>
            <flux:input placeholder="123 Main St, City" wire:model="form.address" icon="map-pin" />
        </flux:field>

        <flux:field>
            <flux:label badge="Optional">Landmark</flux:label>
            <flux:input placeholder="Near Central Park" wire:model="form.landmark" icon="map-pin-house" />
        </flux:field>

        <div class="flex flex-col sm:flex-row gap-3 pt-4">
            <flux:modal.close>
                <flux:button variant="ghost" class="w-full sm:w-auto">Cancel</flux:button>
            </flux:modal.close>
            <flux:spacer />
            <flux:button type="submit" variant="primary" color="blue" class="w-full sm:w-auto">
                Create Contact
            </flux:button>
        </div>
    </form>
</flux:modal>
