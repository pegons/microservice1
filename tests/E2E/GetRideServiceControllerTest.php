<?php

namespace Tests\E2E;

use Tests\TestCase;
use App\Models\RideService;

class GetRideServiceControllerTest extends TestCase
{
    public function testGetRideService()
    {
        $rideServiceToUpdate = RideService::factory()->create();


        $response = $this->get("/ride_service/$rideServiceToUpdate->id");

        $response->assertStatus(200);

        $data = json_decode($response->getContent());
        $this->assertEquals($rideServiceToUpdate->pick_up, $data->pickUp);
        $this->assertEquals($rideServiceToUpdate->drop_off, $data->dropOff);
    }
}
