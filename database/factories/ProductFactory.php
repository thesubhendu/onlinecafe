<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
                'name'        => $this->faker->word(2),
                'description' => $this->faker->sentence(),
                'price'       => $this->faker->numberBetween($min = 3, $max = 6),
                'vendor_id'   => Vendor::all()->random()->id,
                'category_id' => ProductCategory::all()->random()->id,
            ];

    }
}
