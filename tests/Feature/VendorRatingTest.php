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
//    function it_can_be_rated()
//    {
      
//     $vendor = vendor::factory()->create();

//     $vendor->rate(5);

//     $this->assertCount(1, $vendor->ratings);
//    }

//    function it_can_calculate_the_average_rating()
//    {
//     $vendor = vendor::factory()->create();

//     $vendor->rate(5);
//     $vendor->rate(1);

//     $this->assertEquals(3, $vendor->rating());
//    }

//    function it_cannot_be_rated_above_5()
//    {
//     $vendor = vendor::factory()->create();

//     $this->expectException(\InvalidArgumentException::class);

//     $vendor->rate(6);
//    }

//    function it_cannot_be_rated_below_1()
//    {
//     $vendor = vendor::factory()->create();

//     $this->expectException(\InvalidArgumentException::class);

//     $vendor->rate(-1);
//    }

   function it_can_only_be_rated_once_per_user()
   {
    $this->actingAs(User::factory()->create());
    $vendor = vendor::factory()->create();

    $vendor->rate(5);
    $vendor->rate(1);

    $this->assertEquals(1, $vendor->rating());

   }



}
