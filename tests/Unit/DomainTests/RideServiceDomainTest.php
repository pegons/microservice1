<?php

namespace Tests\Unit\DomainTests;

use PHPUnit\Framework\TestCase;
use Microservice\Domain\Exceptions\DomainCreateException;


use Microservice\Domain\RideServiceDomain;
use Tests\DomainFactory\VehicleTypeDomainFactory;

class RideServiceDomainTest extends TestCase
{

    public function testCreateDomain()
    {
        $vehicleType = VehicleTypeDomainFactory::create();

        $rideServiceDomain = new RideServiceDomain([
            'id' => 'uuid',
            'dropOff' => 'name:19.8:18.9',
            'pickUp' => 'otherName:24.8:11.9',
            'vehicleType' => $vehicleType,
        ]);

        $this->assertEquals('uuid', $rideServiceDomain->getUuid());
        $this->assertEquals('name:19.8:18.9', $rideServiceDomain->getDropOff()->getConcatFormat());
        $this->assertEquals('otherName:24.8:11.9', $rideServiceDomain->getPickUp()->getConcatFormat());
    }

    public function testCreateDomainFailed()
    {
        $this->expectException(DomainCreateException::class);
        $this->expectExceptionMessage('Error trying to create a RideServiceDomain');
        $vehicleType = VehicleTypeDomainFactory::create();

        new RideServiceDomain([
            'id' => 'uuid',
            'dropOff' => null,
            'pickUp' => 'otherName:24.8:11.9',
            'vehicleType' => $vehicleType,
        ]);
    }
}
