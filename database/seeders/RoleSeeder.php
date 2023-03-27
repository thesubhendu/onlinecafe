<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Orchid\Platform\Models\Role;


class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $vendorRole = Role::create(
            [
                'name'        => 'Vendor',
                'slug'        => 'vendor',
                'permissions' => [
                    "platform.index"              => "1",
                    "platform.systems.roles"      => "0",
                    "platform.systems.users"      => "0",
                    "platform.systems.attachment" => "0",
                ],
            ]);
    }
}
