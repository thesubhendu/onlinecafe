<?php

namespace Database\Factories;

use App\Models\vendor;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class VendorFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = vendor::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'vendor_name' => $this->faker->company,
            'slug' => $this->faker->company,
            'contact_name' => $this->faker->name,
            'contact_lastname' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'mobile' => $this->faker->PhoneNumber,
            'address' => $this->faker->address,
            'suburb' => $this->faker->cityPrefix,
            'pc' => $this->faker->postcode,
            'state' => $this->faker->stateAbbr,
            'vendor_image' => 'vendor_default.jpg',
            'cardstamps' => 10,
            // 'email_verified_at' => now(),
            // 'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            // 'remember_token' => Str::random(10),
        ];
    }
}
