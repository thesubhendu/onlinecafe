<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class ProductCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductCategory::factory()->create(['name' => 'Coffee', 'slug' => 'coffee']);
        ProductCategory::factory()->create(['name' => 'Hot Chocolate & Tea', 'slug' => 'hot chocolate & tea']);
    }
}
