<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_at' => fake()->date(),
            'total_price' => fake()->numberBetween(40000, 100000),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(
            function (Order $order) {
                $items = Item::inRandomOrder()->limit(rand(1, 5))->get();

                foreach ($items as $item) {
                    $quantity = rand(1, 5);
                    $order->items()->attach($item, ['quantity' => $quantity, 'detail' => fake()->sentence(1)]);
                }
            }
        );
    }
}