<?php

namespace Database\Factories;

use App\Models\OptionType;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionTypeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->unique()->word(1),
        ];
    }
}
