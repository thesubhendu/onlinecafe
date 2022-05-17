<?php

namespace Database\Factories;

use App\Models\OptionType;
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
            'name' => $this->faker->unique()->word(1),
            'price' => $this->faker->numberBetween(1.00, 5),
        ];
    }


    public function coffeeType(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Coffee Type')->first()->id,
            ];
        });
    }

    public function milk(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Milk')->first()->id,
            ];
        });
    }

    public function syrups(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Syrups')->first()->id,
            ];
        });
    }

    public function temperature(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Temperature')->first()->id,
            ];
        });
    }

    public function shots(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Shots')->first()->id,
            ];
        });
    }

    public function sugar(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Sugar')->first()->id,
            ];
        });
    }

    public function sweetener(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Sweetener')->first()->id,
            ];
        });
    }

    public function hotChocolate(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Hot Chocolate')->first()->id,
            ];
        });
    }

    public function teaType(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Tea Type')->first()->id,
            ];
        });
    }

    public function teaOption(): ProductOptionFactory
    {
        return $this->state(function (array $attributes) {
            return [
                'option_type_id' => OptionType::where('name', 'Tea option')->first()->id,
            ];
        });
    }
}
