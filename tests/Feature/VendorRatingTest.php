<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VendorRatingTest extends TestCase
{

    use RefreshDatabase;
   /** @test */

   function it_can_be_rated()
   {
       $this->withoutExceptionHandling();
        // a user is signed in
        $this->actingAs(
            $user = User::factory()->create()
        );
        // We have a Vendor
       $vendor = Vendor::factory()->create();
       //Vendor is rated at 5
       $this->post("/vendor/{vendor->id}/rate", ['rating' => 5]);
       // The Vendor's rating should be 5
       $this->assertEquals(5, $vendor->rating());


   }
}
