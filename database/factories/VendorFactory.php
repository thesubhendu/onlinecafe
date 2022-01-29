<?php

namespace Database\Factories;

use App\Models\Vendor;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_name' => $this->faker->company,
            'abn' => $this->faker->unique()->randomNumber(8),
            'slug' => $this->faker->company,
            'contact_name' => $this->faker->name,
            'contact_lastname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->PhoneNumber,
            'shop_email' => $this->faker->unique()->safeEmail,
            'shop_mobile' => $this->faker->PhoneNumber,
            'address' => $this->faker->address,
            'suburb' => $this->faker->cityPrefix,
            'pc' => $this->faker->postcode,
            'state' => $this->faker->stateAbbr,
            'is_subscribed' => 1,
            'vendor_image' => '',
            'max_stamps' => 10,
        ];
    }
}
