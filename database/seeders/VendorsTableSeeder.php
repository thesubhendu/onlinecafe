<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class VendorsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('vendors')->delete();
        
        \DB::table('vendors')->insert(array (
            0 => 
            array (
                'id' => 1,
                'vendor_name' => 'Murphy-Steuber',
                'slug' => 'Schultz, Hirthe and Armstrong',
                'contact_name' => 'Prof. Susana Collier V',
                'contact_lastname' => 'Gordon Vandervort II',
                'email' => 'zola.abshire@example.com',
            'mobile' => '(03)84841464',
                'address' => '40A Trey Ramp
East Janniemouth, ACT 2967',
                'suburb' => 'North',
                'pc' => '2194',
                'state' => 'WA',
                'cardstamps' => '10',
                'vendor_image' => 'vendor_default.jpg',
                'created_at' => '2021-08-03 04:35:17',
                'updated_at' => '2021-08-03 04:35:17',
            ),
            1 => 
            array (
                'id' => 2,
                'vendor_name' => 'Kulas, Olson and Kirlin',
                'slug' => 'Schultz, Wehner and Bahringer',
                'contact_name' => 'Tobin Nikolaus',
                'contact_lastname' => 'Muhammad Casper',
                'email' => 'stoltenberg.hailey@example.org',
                'mobile' => '5140-4819',
                'address' => '90 Arno Corner
Adaland, ACT 2163',
                'suburb' => 'West',
                'pc' => '2604',
                'state' => 'SA',
                'cardstamps' => '10',
                'vendor_image' => 'vendor_default.jpg',
                'created_at' => '2021-08-03 04:35:17',
                'updated_at' => '2021-08-03 04:35:17',
            ),
            2 => 
            array (
                'id' => 3,
                'vendor_name' => 'Bailey-Cummings',
                'slug' => 'Senger, Hansen and DuBuque',
                'contact_name' => 'Walker Walter',
                'contact_lastname' => 'Miss Lia Stanton DVM',
                'email' => 'karli.ledner@example.org',
                'mobile' => '3061.0298',
                'address' => '407D Cordia Thoroughfare
North Roberto, SA 2642',
                'suburb' => 'St.',
                'pc' => '2619',
                'state' => 'ACT',
                'cardstamps' => '10',
                'vendor_image' => 'vendor_default.jpg',
                'created_at' => '2021-08-03 04:35:17',
                'updated_at' => '2021-08-03 04:35:17',
            ),
        ));
        
        
    }
}