<?php

namespace Database\Seeders;

use App\Models\AllProduct;
use App\Models\ProductCategory;
use Illuminate\Database\Seeder;

class AllProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        AllProduct::factory()->count(10)->state(['category_id' => ProductCategory::first()->id])->create();
    }
}
