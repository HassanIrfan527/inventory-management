<?php

namespace App\Livewire\Contacts\Forms;
use App\Enums\Contacts\PreferredContactMethod;
use App\Enums\Contacts\Source;
use App\Enums\Contacts\Status;
use App\Enums\Contacts\Type;
use App\Models\Contact;

use Livewire\Form;

class ContactForm extends Form
{
    // Essential Information
    public ?string $first_name = null;

    public ?string $last_name = null;

    public ?string $email = null;

    public ?string $phone = null;

    public ?string $type = Type::LEAD->value;

    public ?string $status = Status::ACTIVE->value;

    // Business Information
    public ?string $company_name = null;

    public ?string $job_title = null;

    // Contact Details
    public ?string $preferred_contact_method = PreferredContactMethod::EMAIL->value;

    // Location Details
    public ?string $address = null;

    public ?string $landmark = null;

    public ?string $city = null;

    public ?string $state = null;

    public ?string $country = null;

    public ?string $zip_code = null;

    // CRM & Marketing
    public ?string $source = Source::WEB->value;

    public ?string $date_of_birth = null;

    public ?int $engagement_score = 0;

    public ?string $notes = null;

    protected function rules(): array
    {
        return [
            'first_name' => ['required', 'string', 'min:2', 'max:255'],
            'last_name' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'unique:contacts,email'],
            'phone' => ['nullable', 'regex:/^\+?[1-9]\d{1,14}$/'],
            'type' => ['nullable', 'in:' . implode(',', array_column(Type::cases(), 'value'))],
            'status' => ['nullable', 'in:' . implode(',', array_column(Status::cases(), 'value'))],
            'company_name' => ['nullable', 'string', 'max:255'],
            'job_title' => ['nullable', 'string', 'max:255'],
            'preferred_contact_method' => ['nullable', 'in:' . implode(',', array_column(PreferredContactMethod::cases(), 'value'))],
            'address' => ['nullable', 'string', 'max:255'],
            'landmark' => ['nullable', 'string', 'max:255'],
            'city' => ['nullable', 'string', 'max:100'],
            'state' => ['nullable', 'string', 'max:100'],
            'country' => ['nullable', 'string', 'max:100'],
            'zip_code' => ['nullable', 'string', 'max:20'],
            'source' => ['nullable', 'in:' . implode(',', array_column(Source::cases(), 'value'))],
            'date_of_birth' => ['nullable', 'date', 'before:today'],
            'engagement_score' => ['nullable', 'integer', 'min:0', 'max:100'],
            'notes' => ['nullable', 'string', 'max:1000'],
        ];
    }

    public function messages(): array
    {
        return [
            'phone.regex' => 'Please enter a valid phone number in E.164 format (e.g., +923001234567).',
            'email.unique' => 'This email is already in use by another contact.',
            'date_of_birth.before' => 'Date of birth must be in the past.',
        ];

    }

    public function setContact(Contact $contact): void
    {
        // This is the "magic" line that maps the database values to your public properties automatically.
        $this->fill($contact->toArray());
    }
}
