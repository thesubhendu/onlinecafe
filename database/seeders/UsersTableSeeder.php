<?php

namespace Database\Seeders;

use App\Models\AllProduct;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Eloquent\Model;
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
            Vendor::factory()
                  ->state(function (array $attributes) {
                      return ['vendor_name' => "Webdevmatics Pvt Ltd", 'shop_name' => 'Webdev coffee Shop'];
                  })
            , 'shop')->create([
            'name'   => 'Webdevmatics',
            'email'  => 'webdevmatics@gmail.com',
            'mobile' => 9779809333221,
        ]);


        $vendor2 = User::factory()->has(
            Vendor::factory()
                  ->state(function (array $attributes) {
                      return ['vendor_name' => "Vendor Pvt Ltd", 'shop_name' => 'Vendor coffee Shop'];
                  })
            , 'shop')->create([
            'name'   => 'Vendor',
            'email'  => 'vendor@cafe.np',
            'mobile' => 9779809333222,
        ]);

//        $productOption = ProductOption::where('charge', 1)->random()->limit(10);
        $sizes = config('sizes');
        $vendor1Shop =  $vendor1->shop()->first();
        $vendor2Shop =  $vendor2->shop()->first();
        foreach(AllProduct::all() as $product)
        {
            $data = [
                'name' => $product->name,
                'price' => $product->price,
                'category_id' => $product->category_id,
                'is_stamp' => 1,
                'description' => ''
            ];
            $vendor1Shop->products()->create($data);
            $vendor2Shop->products()->create($data);
        }
        // seed vendor product prices for each sizes
        $this->seedVendorProductPrices($vendor1Shop, $sizes);
        $this->seedVendorProductPrices($vendor2Shop, $sizes);

        //seed vendor product option prices
        $this->seedVendorProductOptions($vendor1Shop);
        $this->seedVendorProductOptions($vendor2Shop);

        //seed vendor loyalty
        $vendor1Shop->update(
            [
                'max_stamps' => 10,
                'free_category' => ProductCategory::inRandomOrder()->first()->id,
                'get_free' => 1
            ]
        );
        $vendor2Shop->update(
            [
                'max_stamps' => 10,
                'free_category' => ProductCategory::inRandomOrder()->first()->id,
                'get_free' => 1
            ]
        );

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
    }

    private function seedVendorProductPrices(Model $vendor, $sizes): void
    {
        $vendor->products()->each(function($product) use ($sizes){
            foreach($sizes as $size)
            {
                $product->productPrices()->updateOrCreate(
                    [
                        'product_id' => $product->id,
                        'size' => $size
                    ],
                    [
                        'price' => $size == 'S' ? $product->price : $product->price + random_int(1, 5),
                    ]
                );
            }
        });
    }

    private function seedVendorProductOptions(Model $vendor): void
    {
         ProductOption::where('charge', 1)->inRandomOrder()->limit(10)->each(function ($option) use($vendor) {
            $vendor->productOptions()->create([
                'name' => $option->name,
                'price' => $option->price +  1,
                'option_type_id' => $option->option_type_id,
                'charge' => $option->charge
            ]);
        });
    }
}
