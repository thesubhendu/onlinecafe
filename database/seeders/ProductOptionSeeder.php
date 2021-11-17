<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;

class ProductOptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProductOption::factory()->count(3)->state(['category_id' => ProductCategory::first()->id])->create();

    }
}
