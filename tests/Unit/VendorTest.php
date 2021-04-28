<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VendorTest extends TestCase
{
   use RefreshDatabase;

   protected function setUp(): void
   {
      parent::setUp();

      $this->vendor = vendor::factory()->create();
      $this->user = user::factory()->create();

   }

   /** @test */ 
   function it_can_be_rated()
   {

    $this->vendor->rate(5, $this->user);

    $this->assertCount(1, $this->vendor->ratings);
   }

   /** @test */ 

   function it_can_calculate_the_average_rating()
   {

    $this->vendor->rate(5, $this->user);
    $this->vendor->rate(1, user::factory()->create());

    $this->assertEquals(3, $this->vendor->rating());
   }

   /** @test */ 

   function it_cannot_be_rated_above_5()
   {

    $this->expectException(\InvalidArgumentException::class);

    $this->vendor->rate(6);
   }

   /** @test */ 

   function it_cannot_be_rated_below_1()
   {

    $this->expectException(\InvalidArgumentException::class);

    $this->vendor->rate(-1);
   }

   /** @test */ 

   function it_can_only_be_rated_once_per_user()
   {
    $this->actingAs($this->user);

    $this->vendor->rate(5);
    $this->vendor->rate(1);

    $this->assertEquals(1, $this->vendor->rating());

   }



}
