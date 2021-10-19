<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('roles')->delete();

        \DB::table('roles')->insert(array (
            0 =>
            array (
                'id' => 1,
                'name' => 'admin',
                'display_name' => 'Administrator',
                'created_at' => '2021-06-24 00:27:49',
                'updated_at' => '2021-06-24 00:27:49',
            ),
            1 =>
            array (
                'id' => 2,
                'name' => 'user',
                'display_name' => 'Normal User',
                'created_at' => '2021-06-24 00:38:07',
                'updated_at' => '2021-06-24 00:38:07',
            ),
            2 =>
            array (
                'id' => 3,
                'name' => 'vendor',
                'display_name' => 'Vendor Owner',
                'created_at' => '2021-06-24 00:38:07',
                'updated_at' => '2021-06-24 00:38:07',
            ),
        ));


    }
}
