<?php

namespace App\Livewire\Contacts;

use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
use App\Livewire\Contacts\Forms\ContactForm;
use App\Services\ContactService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Layout('layouts.app')]
#[Title('Create Contact')]
class Create extends Component
{
    // Section visibility
    public bool $sectionEssential = true;

    public bool $sectionBusiness = false;

    public bool $sectionContact = false;

    public bool $sectionLocation = false;

    public bool $sectionCrm = false;

    public ContactForm $form;

    public function mount()
    {
        //
    }

    public function save(ContactService $contactService): void
    {
        $this->form->validate();
        $contact = $contactService->createContact($this->form->toArray());

        $this->dispatch('toast', message: 'Contact created successfully', type: 'success');
        $this->redirect(route('contact.show', $contact), navigate: true);
    }

    public function cancel(): void
    {
        $this->redirect(route('contacts.all'), navigate: true);
    }

    #[Computed]
    public function typeOptions(): array
    {
        return collect(Type::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    #[Computed]
    public function statusOptions(): array
    {
        return collect(Status::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    #[Computed]
    public function sourceOptions(): array
    {
        return collect(Source::cases())->mapWithKeys(fn ($case) => [$case->value => ucwords(str_replace('_', ' ', $case->value))])->toArray();
    }

    #[Computed]
    public function preferredContactMethodOptions(): array
    {
        return collect(PreferredContactMethod::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.create');
    }
}
