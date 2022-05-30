<?php

namespace Database\Seeders;

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Service::forceCreate([
            'name'=> 'Food'
        ]);
        Service::forceCreate([
            'name'=> 'Coffee'
        ]);
        Service::forceCreate([
            'name'=> 'Drinks'
        ]);
        Service::forceCreate([
            'name'=> 'Pet Friendly'
        ]);
    }
}
