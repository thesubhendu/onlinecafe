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
      
    $vendor = vendor::factory()->make();

    $vendor->rate(5);

    $this->assertCount(1, $vendor->ratings);
   }



}
