<?php

namespace Database\Factories;

use App\Models\ProductCategory;
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

    public function hotChocolateAndTea(): AllProductFactory
    {
        return $this->state(function(array $attributes){
            return [
                'category_id' => ProductCategory::where('name', 'Hot Chocolate & Tea')->first()->id,
            ];
        });
    }

    public function coffee(): AllProductFactory
    {
        return $this->state(function(array $attributes){
            return [
                'category_id' => ProductCategory::where('name', 'Coffee')->first()->id,
            ];
        });
    }
}
