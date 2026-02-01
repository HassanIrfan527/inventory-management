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
        // Validate only essential fields for quick add
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

    public function addMoreDetails()
    {
        // Validate what we have so far
        $this->form->validate();

        // Store form data in session to transfer to full form
        session()->put('contact_draft', [
            'first_name' => $this->form->first_name,
            'last_name' => $this->form->last_name,
            'email' => $this->form->email,
            'phone' => $this->form->phone,
            'address' => $this->form->address,
        ]);

        // Close modal and redirect to full form
        Flux::modal('add-contact-modal')->close();
        $this->redirect(route('contact.create'), navigate: true);
    }
};
?>

<flux:modal name="add-contact-modal" class="w-full max-w-lg" variant="flyout">
    <div class="flex h-full flex-col">
        {{-- Header --}}
        <div class="relative overflow-hidden bg-gradient-to-br from-emerald-600 to-teal-700 px-6 py-8 text-white">
            <div class="relative z-10 flex items-center gap-4">
                <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-white/20 backdrop-blur-md shadow-inner">
                    <flux:icon name="user-plus" class="h-6 w-6" />
                </div>
                <div>
                    <flux:heading size="xl" class="!text-white !font-bold">Quick Add Contact</flux:heading>
                    <flux:text class="!text-emerald-100/80">Save essential details in seconds</flux:text>
                </div>
            </div>
            <div class="absolute -right-12 -top-12 h-40 w-40 rounded-full bg-white/10 blur-3xl"></div>
            <div class="absolute -bottom-8 -left-8 h-24 w-24 rounded-full bg-teal-400/10 blur-2xl"></div>
        </div>

        <div class="flex-1 overflow-y-auto p-6">
            <form class="space-y-5" wire:submit.prevent="store">
                {{-- Names --}}
                <div class="grid grid-cols-2 gap-4">
                    <flux:field>
                        <flux:label>First Name <span class="text-emerald-500">*</span></flux:label>
                        <flux:input wire:model="form.first_name" placeholder="John" icon="user" autofocus />
                        <flux:error name="form.first_name" />
                    </flux:field>

                    <flux:field>
                        <flux:label>Last Name</flux:label>
                        <flux:input wire:model="form.last_name" placeholder="Doe" icon="user" />
                    </flux:field>
                </div>

                {{-- Email --}}
                <flux:field>
                    <flux:label>Email Address</flux:label>
                    <flux:input type="email" wire:model="form.email" placeholder="john@example.com" icon="envelope" />
                    <flux:error name="form.email" />
                </flux:field>

                {{-- Phone --}}
                <flux:field>
                    <flux:label>Phone Number</flux:label>
                    <flux:input wire:model="form.phone" placeholder="+1234567890" icon="phone" />
                    <flux:error name="form.phone" />
                </flux:field>

                {{-- Address --}}
                <flux:field>
                    <flux:label>Address (Location)</flux:label>
                    <flux:input wire:model="form.address" placeholder="123 Main St, City" icon="map-pin" />
                </flux:field>

                {{-- Footer Actions --}}
                <div class="mt-8 space-y-4 pt-4">
                    <div class="flex items-center gap-3">
                        <flux:modal.close class="flex-1">
                            <flux:button variant="ghost" class="w-full">Cancel</flux:button>
                        </flux:modal.close>
                        
                        <flux:button type="submit" variant="primary" icon="check" class="flex-[2] bg-emerald-600 hover:bg-emerald-700 text-white shadow-emerald-200/50 transition-all active:scale-[0.98]">
                            Save Contact
                        </flux:button>
                    </div>

                    <div class="relative flex items-center justify-center py-2">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-zinc-200 dark:border-zinc-800"></div>
                        </div>
                        <span class="relative bg-white px-4 text-[10px] font-bold uppercase tracking-[0.2em] text-zinc-400 dark:bg-zinc-900">
                            or
                        </span>
                    </div>

                    <flux:button wire:click="addMoreDetails" variant="subtle" icon="document-plus" class="w-full justify-center text-emerald-600 hover:!bg-emerald-50 dark:text-emerald-400 dark:hover:!bg-emerald-950/30">
                        Add More Details
                    </flux:button>
                </div>
            </form>
        </div>
    </div>
</flux:modal>
