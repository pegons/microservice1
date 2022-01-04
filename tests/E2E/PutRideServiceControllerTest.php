<?php

namespace Tests\E2E;

use App\Models\RideService;
use App\Models\VehicleType;
use Tests\TestCase;

class PutRideServiceControllerTest extends TestCase
{
    public function testUpdatedRideService()
    {
        $vehicleType = VehicleType::first();

        $rideServiceToUpdate = RideService::factory()->create();

        $params = [
            'id' => (string)$rideServiceToUpdate->id,
            'pickUp' => 'Granada:20,23:89,123312',
            'dropOff' => 'Granada:20,23:89,111',
            'vehicleTypeId' => $vehicleType->id
        ];

        $response = $this->put('/ride_service', $params);

        $response->assertStatus(200);
        $data = json_decode($response->getContent());
        $this->assertEquals($rideServiceToUpdate->id, $data->id);
        $this->assertEquals('Granada:20,23:89,123312', $data->pickUp);
        $this->assertEquals('Granada:20,23:89,111', $data->dropOff);
        $this->assertEquals($vehicleType->id, $data->vehicleTypeId);
    }

    public function testUpdateRideServiceFailed()
    {
        $vehicleType = VehicleType::first();

        $params = [
            'id' => 'no-exists-id',
            'pickUp' => 'Granada:20,23:89,123312',
            'dropOff' => 'Granada:20,23:89,111',
            'vehicleTypeId' => $vehicleType->id
        ];

        $response = $this->put('/ride_service', $params);
        $response->assertStatus(404);
    }
}
