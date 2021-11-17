<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductOptionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->unique()->word(1),
            'price' => $this->faker->numberBetween(0.25, 5),
            'options' => $this->faker->randomElements([
                'pure', 'less pure', 'old', 'great', '1number', 'low grade', 'medium', 'highest',
            ], 4),
        ];
    }
}
