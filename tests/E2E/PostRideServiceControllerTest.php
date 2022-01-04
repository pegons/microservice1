<?php

namespace Tests\E2E;


use App\Models\VehicleType;
use Tests\TestCase;

class PostRideServiceControllerTest extends TestCase
{
    public function testCreateRideService()
    {
        $vehicleType = VehicleType::first();
        $params = [
            'pickUp' => 'Granada:20,23:89,123312',
            'dropOff' => 'Granada:20,23:89,111',
            'vehicleTypeId' => $vehicleType->id
        ];

        $response = $this->post('/ride_service', $params);

        $response->assertStatus(200);
        $data = json_decode($response->getContent());

        $this->assertEquals('Granada:20,23:89,123312', $data->pickUp);
        $this->assertEquals('Granada:20,23:89,111', $data->dropOff);
        $this->assertEquals($vehicleType->id, $data->vehicleTypeId);
    }

    public function testCreateRideServiceFailed()
    {
        $params = [
            'pickUp' => 'Granada:20,23:89,123312',
            'dropOff' => 'Granada:20,23:89,111',
            'vehicleTypeId' => 'No-exists-vehicle-type-id'
        ];

        $response = $this->post('/ride_service', $params);
        $response->assertStatus(404);
    }
}
