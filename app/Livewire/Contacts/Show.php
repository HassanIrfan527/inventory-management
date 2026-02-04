<?php

namespace App\Livewire\Contacts;

use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
use App\Livewire\Contacts\Forms\ContactForm;
use App\Models\Contact;
use App\Services\ContactService;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout('layouts.app')]
class Show extends Component
{
    public Contact $contact;

    public ContactForm $form;

    // Section visibility states
    public bool $sectionEssential = true;

    public bool $sectionContact = false;

    public bool $sectionBusiness = false;

    public bool $sectionLocation = false;

    public bool $sectionCrm = false;

    public function mount(Contact $contact): void
    {
        $this->contact = $contact;
        $this->form->setContact($this->contact);
    }

    public function title(): string
    {
        return $this->contact->name;
    }

    // Auto-save handlers for each field group
    public function updated($field): void
    {
        // Only validate and save the specific field that was updated
        $this->form->validateOnly($field);
        $this->saveField($field);
    }

    protected function saveField(string $field): void
    {
        $contactService = app(ContactService::class);

        // Store old value before update
        $oldValue = $this->contact->{$field};

        $data = match ($field) {
            'first_name', 'last_name' => [
                'first_name' => $this->form->first_name,
                'last_name' => $this->form->last_name,
            ],
            'email' => ['email' => $this->form->email],
            'phone' => ['phone' => $this->form->phone],
            'type' => ['type' => $this->form->type],
            'status' => ['status' => $this->form->status],
            'company_name' => ['company_name' => $this->form->company_name],
            'job_title' => ['job_title' => $this->form->job_title],
            'address' => ['address' => $this->form->address],
            'landmark' => ['landmark' => $this->form->landmark],
            'city' => ['city' => $this->form->city],
            'state' => ['state' => $this->form->state],
            'country' => ['country' => $this->form->country],
            'zip_code' => ['zip_code' => $this->form->zip_code],
            'source' => ['source' => $this->form->source],
            'date_of_birth' => ['date_of_birth' => $this->form->date_of_birth],
            'engagement_score' => ['engagement_score' => $this->form->engagement_score],
            'preferred_contact_method' => ['preferred_contact_method' => $this->form->preferred_contact_method],
            'notes' => ['notes' => $this->form->notes],
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

    // public function cancelEdit(): void
    // {
    //     $this->loadContactData();
    //     $this->editingSection = null;
    //     $this->resetValidation();
    // }

    public function addNote(): void
    {
        $this->validateOnly('notes');

        $this->contact->logActivity('Note added', null, ['content' => $this->form->notes]);

        $this->form->notes = '';
        $this->dispatch('toast', message: 'Note added successfully', type: 'success');
    }

    #[Computed]
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
        return collect(Source::cases())->mapWithKeys(fn ($case) => [$case->value => $case->value])->toArray();
    }

    #[Computed]
    public function preferredContactMethodOptions(): array
    {
        return collect(PreferredContactMethod::cases())->mapWithKeys(fn ($case) => [$case->value => $case->value])->toArray();
    }

    public function render()
    {
        return view('livewire.contacts.show');
    }
}
