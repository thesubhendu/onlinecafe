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
    public function itCanBeRated()
    {

        $this->vendor->rate(5, $this->user);

        $this->assertCount(1, $this->vendor->ratings);
    }

   /** @test */

    public function itCanCalculateTheAverageRating()
    {

        $this->vendor->rate(5, $this->user);
        $this->vendor->rate(1, user::factory()->create());

        $this->assertEquals(3, $this->vendor->rating());
    }

   /** @test */

    public function itCannotBeRatedAbove5()
    {

        $this->expectException(\InvalidArgumentException::class);

        $this->vendor->rate(6);
    }

   /** @test */

    public function itCannotBeRatedBelow1()
    {

        $this->expectException(\InvalidArgumentException::class);

        $this->vendor->rate(-1);
    }

   /** @test */

    public function itCanOnlyBeRatedOncePerUser()
    {
        $this->actingAs($this->user);

        $this->vendor->rate(5);
        $this->vendor->rate(1);

        $this->assertEquals(1, $this->vendor->rating());
    }
}
