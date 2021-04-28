<?php

namespace Database\Factories;

use App\Models\vendor;
use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;

class productFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            return [
                'ProductName' => $this->faker->word,
                'ProductDescription' => $this->faker->sentence,
                'productPrice' => $this->faker->numberBetween($min = 3, $max = 6),
                'vendor_id' => vendor::all()->random()->id,
            ];
        
    }
}
