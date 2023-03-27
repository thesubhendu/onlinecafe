<?php

namespace Database\Seeders;

use App\Models\OptionType;
use App\Models\ProductCategory;
use App\Models\ProductOption;
use Illuminate\Database\Seeder;

class OptionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OptionType::factory()->coffee()->create(['name' =>'Coffee Type', 'order_no' => 1]);
        OptionType::factory()->coffee()->create(['name' =>'Milk', 'order_no' => 2]);
        OptionType::factory()->coffee()->create(['name' =>'Sugar', 'order_no' => 3]);
        OptionType::factory()->coffee()->create(['name' =>'Sweetener', 'order_no' => 4]);
        OptionType::factory()->coffee()->create(['name' =>'Syrups', 'order_no' => 5]);
        OptionType::factory()->coffee()->create(['name' =>'Shots', 'order_no' => 6]);
        OptionType::factory()->coffee()->create(['name' =>'Temperature', 'order_no' => 7]);
        OptionType::factory()->coffee()->create(['name' =>'Hot Chocolate', 'order_no' => 8]);
        OptionType::factory()->coffee()->create(['name' =>'Tea Type', 'order_no' => 9]);
        OptionType::factory()->hotChocolateAndTea()->create(['name' =>'Tea option', 'order_no' => 1]);
    }
}
