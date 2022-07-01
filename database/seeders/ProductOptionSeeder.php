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
//        Default Options
//        'Coffee Type' => 'House Blend',
//        'Milk'        => 'Full Cream',
//        'Sugar'       => 'No Sugar',
//        'Syrups'      => 'No thanks'

        ProductOption::factory()->coffeeType()->create([
            'name' => 'House Blend',
            'charge' => 0,
            'price' => 0,
            'default_option' => true,
        ]);

        ProductOption::factory()->coffeeType()->create([
            'name' => 'Single Origin',
            'charge' => 1,
        ]);

        ProductOption::factory()->coffeeType()->create([
            'name' => 'Decaf',
            'charge' => 1,
        ]);

        // Milk
        ProductOption::factory()->milk()->create([
            'name' => 'Full Cream',
            'charge' => 0,
            'price' => 0,
            'default_option' => true,
        ]);
        ProductOption::factory()->milk()->create([
            'name' => 'Skim',
            'charge' => 0,
            'price' => 0
        ]);
        ProductOption::factory()->milk()->create([
            'name' => 'Soy',
            'charge' => 1,
        ]);
        ProductOption::factory()->milk()->create([
            'name' => 'Oat',
            'charge' => 1,
        ]);
        ProductOption::factory()->milk()->create([
            'name' => 'Zymil',
            'charge' => 1,
        ]);

        // Syrups
        ProductOption::factory()->syrups()->create([
            'name' => 'No thanks',
            'charge' => 0,
            'price' => 0,
            'default_option' => true,
        ]);
        ProductOption::factory()->syrups()->create([
            'name' => 'Vanilla',
            'charge' => 1,
        ]);
        ProductOption::factory()->syrups()->create([
            'name' => 'Caramel',
            'charge' => 1,
        ]);
        ProductOption::factory()->syrups()->create([
            'name' => 'Hazelnut',
            'charge' => 1,
        ]);

        // Temperature
        ProductOption::factory()->temperature()->create([
            'name' => 'Normal',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->temperature()->create([
            'name' => 'Extra Large',
            'charge' => 0,
            'price' => 0,
        ]);

        // Shots
        ProductOption::factory()->shots()->create([
            'name' => 'Regular',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->shots()->create([
            'name' => 'Extra Shot',
            'charge' => 1,
        ]);
        ProductOption::factory()->shots()->create([
            'name' => 'Half Strength',
            'charge' => 0,
            'price' => 0,
        ]);

        // Sugar
        ProductOption::factory()->sugar()->create([
            'name' => 'No Sugar',
            'charge' => 0,
            'price' => 0,
            'default_option' => true,
        ]);
        ProductOption::factory()->sugar()->create([
            'name' => 'Raw',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sugar()->create([
            'name' => '1',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sugar()->create([
            'name' => '2',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sugar()->create([
            'name' => '3',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sugar()->create([
            'name' => 'Halve',
            'charge' => 0,
            'price' => 0,
        ]);

        // Sweetener
        ProductOption::factory()->sweetener()->create([
            'name' => '1',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sweetener()->create([
            'name' => '2',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->sweetener()->create([
            'name' => '3',
            'charge' => 0,
            'price' => 0,
        ]);

        // Hot Chocolate
        ProductOption::factory()->hotChocolate()->create([
            'name' => 'Marshmallow',
            'charge' => 1,
        ]);
        ProductOption::factory()->hotChocolate()->create([
            'name' => 'Chocolate Shot',
            'charge' => 1,
        ]);
        ProductOption::factory()->hotChocolate()->create([
            'name' => 'Whipped Cream',
            'charge' => 1,
        ]);

        // Tea type
        ProductOption::factory()->teaType()->create([
            'name' => 'English Breakfast',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Camoline',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Green Tea',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Earl Grey',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Peppermint',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Jasmine',
            'charge' => 0,
            'price' => 0,
        ]);
        ProductOption::factory()->teaType()->create([
            'name' => 'Chai Tea',
            'charge' => 0,
            'price' => 0,
        ]);

        // Tea option
        ProductOption::factory()->teaOption()->create([
            'name' => 'Honey',
            'charge' => 1,
        ]);
    }
}
