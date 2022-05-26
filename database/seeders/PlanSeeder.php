<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Plan::forceCreate([
           'title'=>'Monthly',
           'slug'=>'monthly',
           'display_price'=>'19',
           'stripe_id'=>'price_1JjoA2BTgpSG0mgbNQhtbBxL'
        ]);

        Plan::forceCreate([
           'title'=>'Yearly',
           'slug'=>'yearly',
            'display_price'=>'99',
            'stripe_id'=>'price_1Jm95zBTgpSG0mgblvuOgHqu'
        ]);

    }
}
