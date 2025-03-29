<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Job>
 */
class JobFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'employer_id' => Employer::factory(),
            'title' => fake()->jobTitle(),
            'description' => fake()->text(255),
            'body' => fake()->paragraph(10),
            'url' => fake()->url(),
            'type' => fake()->randomElement(['Full Time', 'Part Time', 'Contract']),
            'pay_type' => fake()->randomElement(['Salary', 'Hourly']),
            'minimum_pay' => fake()->numberBetween(10000, 100000),
            'maximum_pay' => fake()->numberBetween(100000, 1000000),
        ];
    }
}
