<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_number' => $this->faker->unique()->numberBetween(1, 10000),
            'user_id' => $this->faker->numberBetween(1, 9),
            'vendor_id' => $this->faker->numberBetween(1, 9),
            'order_total' => $this->faker->numberBetween(1, 1000),
            'sub_total' => $this->faker->numberBetween(1, 1000),
            'created_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
            'status' => $this->faker->randomElement(['pending', 'processing', 'completed', 'cancelled']),
        ];
    }
}
