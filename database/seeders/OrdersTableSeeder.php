<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {


        \DB::table('orders')->delete();

        \DB::table('orders')->insert(array (
            0 =>
                array(
                    'id'             => 1,
                    'date'           => '2021-08-03 04:35:17',
                    'order_number'   => '6108c7d6800e4',
                    'confirmed_at'   => now(),
                    'payment_method' => 'in_store',
                    'order_total'    => 3,
                    'user_id'        => 6,
                    'vendor_id'      => 2,
                    'created_at'     => '2021-08-03 04:36:38',
                    'updated_at'     => '2021-08-03 04:36:38',
                ),
        ));


    }
}
