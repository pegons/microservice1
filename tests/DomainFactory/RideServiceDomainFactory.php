<?php

namespace Tests\DomainFactory;

use Microservice\Domain\RideServiceDomain;
use Microservice\Domain\Shared\ValueObject\Uuid;
use Tests\DomainFactory\VehicleTypeDomainFactory;

class RideServiceDomainFactory
{
    public static function create(?array $params = []): RideServiceDomain
    {
        $defaultParams = [
            'id' => Uuid::random()->value(),
            'dropOff' => 'name:19.8:18.9',
            'pickUp' => 'otherName:24.8:11.9',
            'vehicleType' => VehicleTypeDomainFactory::create(),
        ];

        return new RideServiceDomain(array_merge($defaultParams, $params));
    }
}
