<?php

namespace Database\Seeders;

use App\Vendor;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;


class VendorsTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
            // DB::table('vendors')->insert([
            //     'vendor_name' => Str::random(10),
            //     'slug' => '',
            //     'contact_name' => Str::random(10),
            //     'contact_lastname' => Str::random(10),
            //     'email' => Str::random(10).'@gmail.com',
            //     'mobile' => '',
            //     'address' => '',
            //     'suburb' => '',
            //     'pc' => '',
            //     'state' => 'QLD',
            //     'cardstamps' => [10,6][array_rand([10,6])],
            // ]);
        
        
    }
}
