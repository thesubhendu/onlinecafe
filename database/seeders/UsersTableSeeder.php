<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::factory()->has(Vendor::factory(), 'shop')->create([
            'email'  => 'webdevmatics@gmail.com',
            'mobile' => 9779809333221, 'role_id' => '1',
        ]);

        User::factory()->has(Vendor::factory(), 'shop')->count(10)->create(['role_id' => '3']);
    }
}
