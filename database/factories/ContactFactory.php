<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Contact>
 */
class ContactFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'email' => $this->faker->unique()->safeEmail(),
            'phone' => $this->faker->e164PhoneNumber(),
            'address' => $this->faker->streetAddress(),
            'landmark' => $this->faker->word(),
            'type' => \App\Enums\Contacts\Type::CUSTOMER,
            'status' => \App\Enums\Contacts\Status::ACTIVE,
            'source' => \App\Enums\Contacts\Source::WEB,
            'company_name' => $this->faker->company(),
            'job_title' => $this->faker->jobTitle(),
            'city' => $this->faker->city(),
            'state' => $this->faker->state(),
            'country' => $this->faker->country(),
            'zip_code' => $this->faker->postcode(),
            'notes' => $this->faker->paragraph(),
            'date_of_birth' => $this->faker->date(),
            'preferred_contact_method' => \App\Enums\Contacts\PreferredContactMethod::EMAIL,
            'engagement_score' => $this->faker->numberBetween(0, 100),
            'custom_fields' => [],
        ];
    }
}
