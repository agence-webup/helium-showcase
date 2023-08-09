<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
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
        $created_at = $this->faker->dateTimeBetween('-2 year', 'now');

        return [
            'name' => $this->faker->word,
            'price' => $this->faker->randomFloat(4, 0, 9999),
            'deleted_at' => $this->faker->optional()->dateTimeBetween($created_at, 'now'),
            'created_at' => $this->faker->dateTimeBetween('-2 year', 'now'),
            'updated_at' => $this->faker->dateTimeBetween($created_at, 'now'),
        ];
    }
}
