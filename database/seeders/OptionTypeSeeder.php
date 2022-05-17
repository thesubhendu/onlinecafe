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
        OptionType::factory()->coffee()->create(['name' =>'Coffee Type']);
        OptionType::factory()->coffee()->create(['name' =>'Milk']);
        OptionType::factory()->coffee()->create(['name' =>'Syrups']);
        OptionType::factory()->coffee()->create(['name' =>'Temperature']);
        OptionType::factory()->coffee()->create(['name' =>'Shots']);
        OptionType::factory()->coffee()->create(['name' =>'Sugar']);
        OptionType::factory()->coffee()->create(['name' =>'Sweetener']);
        OptionType::factory()->coffee()->create(['name' =>'Hot Chocolate']);
        OptionType::factory()->coffee()->create(['name' =>'Tea Type']);
        OptionType::factory()->hotChocolateAndTea()->create(['name' =>'Tea option']);
    }
}
