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

        $coffeeIds = [];

        $coffeeIds[] = OptionType::factory()->create(['name' =>'Coffee Type', 'order_no' => 1])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Milk', 'order_no' => 2])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Sugar', 'order_no' => 3])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Sweetener', 'order_no' => 4])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Syrups', 'order_no' => 5])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Shots', 'order_no' => 6])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Temperature', 'order_no' => 7])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Hot Chocolate', 'order_no' => 8])->id;
        $coffeeIds[] = OptionType::factory()->create(['name' =>'Tea Type', 'order_no' => 9])->id;

        ProductCategory::where('name', 'Coffee')->first()->optionTypes()->sync($coffeeIds);

        $teaId = OptionType::factory()->create(['name' =>'Tea option', 'order_no' => 1])->id;

        ProductCategory::where('name', 'Hot Chocolate & Tea')->first()->optionTypes()->sync($teaId);

    }
}
