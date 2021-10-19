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

    public function itCannotBeRatedByGuests()
    {

        $vendor = Vendor::factory()->create();
       //Vendor is rated at 5
        $this->post("/vendor/{$vendor->id}/rate")->assertRedirect('login');

        $this->assertEmpty($vendor->ratings);
    }

   /** @test */

    public function itCanBeRatedByAuthenticatedUsers()
    {
        // a user is signed in
        $this->actingAs(
            $user = User::factory()->create()
        );
        // We have a Vendor
        $vendor = Vendor::factory()->create();
       //Vendor is rated at 5
        $this->post("/vendor/{$vendor->id}/rate", ['rating' => 5]);
       // The Vendor's rating should be 5
        $this->assertEquals(5, $vendor->rating());
    }

   /** @test */

    public function itCanUpdateAUsersRating()
    {
        // a user is signed in
        $this->actingAs(
            $user = User::factory()->create()
        );
        // We have a Vendor
        $vendor = Vendor::factory()->create();
       //Vendor is rated at 5
        $this->post("/vendor/{$vendor->id}/rate", ['rating' => 5]);
       // The Vendor's rating should be 5
        $this->assertEquals(5, $vendor->rating());
        // the user then rates the vendor should be 1
    //    $this->post("/vendor/{$vendor->id}/rate", ['rating' => 1]);
    //      // the vendor's rating should be 1
    //    $this->assertEquals(1, $vendor->rating());
    }

/** @test */

    public function itRequiresAValidRating()
    {
        $this->actingAs(
            $user = User::factory()->create()
        );
    // We have a Vendor
        $vendor = Vendor::factory()->create();
   //Vendor is rated at 5
        $this->post("/vendor/{$vendor->id}/rate")->assertSessionHasErrors('rating');

        $this->post("/vendor/{$vendor->id}/rate", ['rating' => 'foo'])->assertSessionHasErrors('rating');
    }
}
