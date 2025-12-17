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
            "name" => $this->faker->name(),
            "email" => $this->faker->unique()->safeEmail(),
            "phone" => $this->faker->phoneNumber(),
            "whatsapp_no" => $this->faker->phoneNumber(),
            "address" => $this->faker->address(),
            "landmark" => $this->faker->word(),
        ];
    }
}
