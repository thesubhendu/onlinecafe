<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(5)->create();
        $this->call(PlanSeeder::class);
        $this->call(ProductCategorySeeder::class);
        $this->call(AllProductSeeder::class);
        $this->call(OptionTypeSeeder::class);
        $this->call(ProductOptionSeeder::class);

         if(app()->environment('production')){
            $this->call(RoleSeeder::class);
        }else{
             $this->call(UsersTableSeeder::class);
             $this->call(OrdersTableSeeder::class);
         }

//        Product::factory(150)->create();
        $this->call(ServicesSeeder::class);
    }
}
