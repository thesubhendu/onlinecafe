<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class AllProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'  => $this->faker->name,
            'price' => $this->faker->numberBetween(10, 50),
        ];
    }
}
