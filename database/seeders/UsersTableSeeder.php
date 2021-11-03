<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(
            Vendor::factory()->has(
                Product::factory()->count(10)
            )
                  ->state(function (array $attributes) {
                      return ['vendor_name' => "Webdev ko Shop"];
                  })
            , 'shop')->create([
            'name'   => 'Webdevmatics',
            'email'  => 'webdevmatics@gmail.com',
            'mobile' => 9779809333221, 'role_id' => '1',
        ]);

        User::factory()
            ->has(
                Vendor::factory()->has(
                    Product::factory()->count(5)
                ),
                'shop')
            ->count(5)
            ->create(['role_id' => '3']); //vendors

        User::factory()->count(5)->create(['role_id' => '2']); //customers
    }
}
