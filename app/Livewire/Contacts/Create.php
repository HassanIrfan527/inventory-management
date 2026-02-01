<?php

namespace App\Livewire\Contacts;

use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Component;

class Create extends Component
{
    // Section visibility
    public bool $sectionEssential = true;

    public bool $sectionBusiness = false;

    public bool $sectionContact = false;

    public bool $sectionLocation = false;

    public bool $sectionCrm = false;

    // Essential Information
    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $phone = null;

    public ?string $type = null;

    public ?string $status = 'active';

    // Business Information
    public ?string $company_name = null;

    public ?string $job_title = null;

    // Contact Details
    public ?string $preferred_contact_method = null;

    // Location Details
    public ?string $address = null;

    public ?string $landmark = null;

    public ?string $city = null;

    public ?string $state = null;

    public ?string $country = null;

    public ?string $zip_code = null;

    // CRM & Marketing
    public ?string $source = null;

    public ?string $date_of_birth = null;

    public ?int $engagement_score = null;

    public ?string $notes = null;

    public function mount()
    {
        // Check for draft data from session (from quick-add modal)
        if ($draft = session()->pull('contact_draft')) {
            $this->first_name = $draft['first_name'] ?? null;
            $this->last_name = $draft['last_name'] ?? null;
            $this->email = $draft['email'] ?? null;
            $this->phone = $draft['phone'] ?? null;
            $this->address = $draft['address'] ?? null;
        }
    }

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:contacts,email'],
            'phone' => ['nullable', 'regex:/^\+?[1-9]\d{1,14}$/'],
            'type' => ['nullable', 'in:'.implode(',', array_column(Type::cases(), 'value'))],
            'status' => ['nullable', 'in:'.implode(',', array_column(Status::cases(), 'value'))],
            'company_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['nullable', 'in:'.implode(',', array_column(PreferredContactMethod::cases(), 'value'))],
            'address' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'source' => ['nullable', 'in:'.implode(',', array_column(Source::cases(), 'value'))],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'engagement_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function save(ContactService $contactService): void
    {
        $this->validate();

        $data = [
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'type' => $this->type,
            'status' => $this->status,
            'company_name' => $this->company_name,
            'job_title' => $this->job_title,
            'preferred_contact_method' => $this->preferred_contact_method,
            'address' => $this->address,
            'landmark' => $this->landmark,
            'city' => $this->city,
            'state' => $this->state,
            'country' => $this->country,
            'zip_code' => $this->zip_code,
            'source' => $this->source,
            'date_of_birth' => $this->date_of_birth,
            'engagement_score' => $this->engagement_score,
            'notes' => $this->notes,
        ];

        $contact = $contactService->createContact($data);

        $this->dispatch('toast', message: 'Contact created successfully', type: 'success');
        $this->redirect(route('contact.show', $contact), navigate: true);
    }

    public function cancel(): void
    {
        $this->redirect(route('contacts.all'), navigate: true);
    }

    #[\Livewire\Attributes\Computed]
    public function typeOptions(): array
    {
        return collect(Type::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    #[\Livewire\Attributes\Computed]
    public function statusOptions(): array
    {
        return collect(Status::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    #[\Livewire\Attributes\Computed]
    public function sourceOptions(): array
    {
        return collect(Source::cases())->mapWithKeys(fn ($case) => [$case->value => ucwords(str_replace('_', ' ', $case->value))])->toArray();
    }

    #[\Livewire\Attributes\Computed]
    public function preferredContactMethodOptions(): array
    {
        return collect(PreferredContactMethod::cases())->mapWithKeys(fn ($case) => [$case->value => ucfirst($case->value)])->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.create')->layout('layouts.app', ['title' => 'Create Contact']);
    }
}
