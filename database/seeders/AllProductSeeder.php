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
        AllProduct::factory()->tea()->create([ 'name' => 'English Breakfast' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Camoline' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Green Tea' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Earl Grey' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Peppermint' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Jasmine' ]);
        AllProduct::factory()->tea()->create([ 'name' => 'Chai Tea' ]);

        AllProduct::factory()->coffee()->create([ 'name' => 'House Blend' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Single Origin' ]);
        AllProduct::factory()->coffee()->create([ 'name' => 'Decaf' ]);
    }
}
