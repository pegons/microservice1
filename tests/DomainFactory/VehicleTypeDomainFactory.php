<?php

namespace Tests\DomainFactory;


use Illuminate\Support\Str;
use Microservice\Domain\VehicleTypeDomain;

class VehicleTypeDomainFactory
{
    public static function create(?array $params = []): VehicleTypeDomain
    {

        $defaultParams = [
            'id' => (string)Str::uuid(),
            'name' => 'default name',
            'key' => 'default',
        ];

        return new VehicleTypeDomain(array_merge($defaultParams, $params));
    }
}
