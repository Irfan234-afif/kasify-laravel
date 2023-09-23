<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\History>
 */
class HistoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->unique()->sentence(6),
            'amount' => fake()->numberBetween(1, 10),
            'total_price' => fake()->numberBetween(30000, 80000),
            'request' => fake()->sentence(fake()->numberBetween(1, 5)),
            'done_at' => fake()->date(),
        ];
    }
}