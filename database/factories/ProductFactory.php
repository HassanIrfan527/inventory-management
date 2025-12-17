<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "product_id" => $this->faker->unique()->bothify('PROD-#####'),
            "name" => $this->faker->word(),
            "description" => $this->faker->sentence(),
            "purchase_price" => $this->faker->randomFloat(2, 10, 1000),
            "delivery_charges" => $this->faker->randomFloat(2, 5, 100),
            "retail_price" => $this->faker->randomFloat(2, 20, 1500),
        ];
    }
}
