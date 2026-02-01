<?php

namespace App\Livewire\Contacts;

use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Contact $contact;

    // Section visibility states
    public bool $sectionEssential = true;

    public bool $sectionContact = false;

    public bool $sectionBusiness = false;

    public bool $sectionLocation = false;

    public bool $sectionCrm = false;

    // Editing states
    public ?string $editingSection = null;

    // Basic Info
    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $phone = null;

    // Classification
    public ?string $type = null;

    public ?string $status = null;

    public ?string $source = null;

    // Business Info
    public ?string $company_name = null;

    public ?string $job_title = null;

    // Location
    public ?string $address = null;

    public ?string $landmark = null;

    public ?string $city = null;

    public ?string $state = null;

    public ?string $country = null;

    public ?string $zip_code = null;

    // CRM & Marketing
    public ?string $notes = null;

    public ?string $date_of_birth = null;

    public ?string $preferred_contact_method = null;

    public ?int $engagement_score = null;

    // Notes
    public string $note = '';

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:contacts,email,'.$this->contact->id],
            'phone' => ['nullable', 'regex:/^\+?[1-9]\d{1,14}$/'],
            'type' => ['nullable', 'in:customer,supplier,lead'],
            'status' => ['nullable', 'in:active,inactive,blocked'],
            'source' => ['nullable', 'in:Web,Referral,Social Media,Advertisement,Other'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'address' => ['nullable', 'string', 'max:500'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'preferred_contact_method' => ['nullable', 'in:Email,Phone,Mail,SMS,Other'],
            'engagement_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'note' => ['required', 'string', 'min:3'],
        ];
    }

    protected function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid phone number in E.164 format (e.g., +1234567890).',
            'email.unique' => 'This email is already in use by another contact.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
        ];
    }

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
        $this->loadContactData();
    }

    protected function loadContactData(): void
    {
        $this->first_name = $this->contact->first_name;
        $this->last_name = $this->contact->last_name;
        $this->email = $this->contact->email;
        $this->phone = $this->contact->phone;
        $this->type = $this->contact->type?->value;
        $this->status = $this->contact->status?->value;
        $this->source = $this->contact->source?->value;
        $this->company_name = $this->contact->company_name;
        $this->job_title = $this->contact->job_title;
        $this->address = $this->contact->address;
        $this->landmark = $this->contact->landmark;
        $this->city = $this->contact->city;
        $this->state = $this->contact->state;
        $this->country = $this->contact->country;
        $this->zip_code = $this->contact->zip_code;
        $this->notes = $this->contact->notes;
        $this->date_of_birth = $this->contact->date_of_birth?->format('Y-m-d');
        $this->preferred_contact_method = $this->contact->preferred_contact_method?->value;
        $this->engagement_score = $this->contact->engagement_score;
    }

    public function editSection(string $section): void
    {
        // Deprecated - using inline editing now
    }

    // Auto-save handlers for each field group
    public function updated($field): void
    {
        // Only validate and save the specific field that was updated
        $this->validateOnly($field);
        $this->saveField($field);
    }

    protected function saveField(string $field): void
    {
        $contactService = app(ContactService::class);

        // Store old value before update
        $oldValue = $this->contact->{$field};

        $data = match ($field) {
            'first_name', 'last_name' => [
                'first_name' => $this->first_name,
                'last_name' => $this->last_name,
            ],
            'email' => ['email' => $this->email],
            'phone' => ['phone' => $this->phone],
            'type' => ['type' => $this->type],
            'status' => ['status' => $this->status],
            'company_name' => ['company_name' => $this->company_name],
            'job_title' => ['job_title' => $this->job_title],
            'address' => ['address' => $this->address],
            'landmark' => ['landmark' => $this->landmark],
            'city' => ['city' => $this->city],
            'state' => ['state' => $this->state],
            'country' => ['country' => $this->country],
            'zip_code' => ['zip_code' => $this->zip_code],
            'source' => ['source' => $this->source],
            'date_of_birth' => ['date_of_birth' => $this->date_of_birth],
            'engagement_score' => ['engagement_score' => $this->engagement_score],
            'preferred_contact_method' => ['preferred_contact_method' => $this->preferred_contact_method],
            'notes' => ['notes' => $this->notes],
            default => [],
        };

        if (! empty($data)) {
            $contactService->updateContact($this->contact, $data);
            $this->contact->refresh();

            // Log detailed activity with field changes
            $this->logFieldChange($field, $oldValue, $this->{$field});

            $this->dispatch('toast', message: 'Updated successfully', type: 'success');
        }
    }

    protected function logFieldChange(string $field, $oldValue, $newValue): void
    {
        // Human-readable field names
        $fieldLabels = [
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'email' => 'Email',
            'phone' => 'Phone',
            'type' => 'Contact Type',
            'status' => 'Status',
            'company_name' => 'Company Name',
            'job_title' => 'Job Title',
            'address' => 'Address',
            'landmark' => 'Landmark',
            'city' => 'City',
            'state' => 'State',
            'country' => 'Country',
            'zip_code' => 'ZIP Code',
            'source' => 'Source',
            'date_of_birth' => 'Date of Birth',
            'engagement_score' => 'Engagement Score',
            'preferred_contact_method' => 'Preferred Contact Method',
            'notes' => 'Notes',
        ];

        $fieldLabel = $fieldLabels[$field] ?? ucfirst(str_replace('_', ' ', $field));

        // Format values for display
        $oldDisplay = $this->formatValueForDisplay($field, $oldValue);
        $newDisplay = $this->formatValueForDisplay($field, $newValue);

        // Only log if value actually changed
        if ($oldDisplay !== $newDisplay) {
            $description = "Updated {$fieldLabel}";

            activity()
                ->performedOn($this->contact)
                ->withProperties([
                    'field' => $field,
                    'field_label' => $fieldLabel,
                    'old_value' => $oldDisplay,
                    'new_value' => $newDisplay,
                ])
                ->log($description);
        }
    }

    protected function formatValueForDisplay(string $field, $value): string
    {
        if (is_null($value) || $value === '') {
            return 'Not set';
        }

        // Handle enum values
        if (in_array($field, ['type', 'status', 'source', 'preferred_contact_method'])) {
            return ucfirst((string) $value);
        }

        // Handle date values
        if ($field === 'date_of_birth' && $value instanceof \Carbon\Carbon) {
            return $value->format('M d, Y');
        }

        if ($field === 'date_of_birth' && is_string($value)) {
            return \Carbon\Carbon::parse($value)->format('M d, Y');
        }

        return (string) $value;
    }

    public function save(ContactService $contactService): void
    {
        // Deprecated - using blur-to-save now
    }

    protected function getSectionValidationRules(?string $section): array
    {
        // Deprecated
        return [];
    }

    protected function getSectionData(?string $section): array
    {
        // Deprecated
        return [];
    }

    public function cancelEdit(): void
    {
        $this->loadContactData();
        $this->editingSection = null;
        $this->resetValidation();
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
        return collect(Source::cases())->mapWithKeys(fn ($case) => [$case->value => $case->value])->toArray();
    }

    #[\Livewire\Attributes\Computed]
    public function preferredContactMethodOptions(): array
    {
        return collect(PreferredContactMethod::cases())->mapWithKeys(fn ($case) => [$case->value => $case->value])->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
