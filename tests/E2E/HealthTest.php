<?php

namespace Tests\E2E;

use App\Models\RideService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class HealthTest extends TestCase
{
    /**
     * A basic health test.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $rides = RideService::factory(1)->create();

        $this->assertEquals('ok', $response->getContent());
    }
}
