<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Orchid\Platform\Models\Role;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        $vendorRole = Role::create(
            [
                'name'        => 'Vendor',
                'slug'        => 'vendor',
                'permissions' => [
                    "platform.index"              => "1",
                    "platform.systems.roles"      => "0",
                    "platform.systems.users"      => "0",
                    "platform.systems.attachment" => "0",
                ],
            ]);

        Artisan::call('orchid:admin admin admin@cafe.np password');

        User::factory()->create(['name' => 'Customer', 'email' => 'customer@cafe.np']); //customer

        $vendor1 = User::factory()->has(
            Vendor::factory()->has(
                Product::factory()->count(10)
            )
                  ->state(function (array $attributes) {
                      return ['vendor_name' => "Webdevmatics Pvt Ltd", 'shop_name' => 'Webdev coffee Shop'];
                  })
            , 'shop')->create([
            'name'   => 'Webdevmatics',
            'email'  => 'webdevmatics@gmail.com',
            'mobile' => 9779809333221,
        ]);

        $vendor2 = User::factory()->has(
            Vendor::factory()->has(
                Product::factory()->count(3)
            )
                  ->state(function (array $attributes) {
                      return ['vendor_name' => "Vendor Pvt Ltd", 'shop_name' => 'Vendor coffee Shop'];
                  })
            , 'shop')->create([
            'name'   => 'Vendor',
            'email'  => 'vendor@cafe.np',
            'mobile' => 9779809333222,
        ]);

        $vendor1->addRole($vendorRole);
        $vendor2->addRole($vendorRole);

        User::factory()
            ->has(
                Vendor::factory()->has(
                    Product::factory()->count(5)
                ),
                'shop')
            ->count(5)
            ->create()->each(fn($user) => $user->addRole($vendorRole)); //vendors

//        User::factory()->count(5)->create(['role_id' => '2']); //customers
    }
}
