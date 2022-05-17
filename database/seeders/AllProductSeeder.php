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
        // Coffee
        AllProduct::factory()->coffee()->create([ 'name' => 'Cappuccino' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Espresso' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Flat White' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Ristretto' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Latte' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Chai Latte' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Long Black' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Macchito' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Piccolo' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Long Macchiato' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Babycino' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Pupacino' ]);

        // Tea
        AllProduct::factory()->hotChocolateAndTea()->create([ 'name' => 'Hot Chocolate' ]);
        AllProduct::factory()->hotChocolateAndTea()->create([ 'name' => 'Mocha' ]);
        AllProduct::factory()->hotChocolateAndTea()->create([ 'name' => 'Tea' ]);
    }
}
