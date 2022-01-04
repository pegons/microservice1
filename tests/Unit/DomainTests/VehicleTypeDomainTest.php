<?php

namespace Tests\Unit\DomainTests;

use App\Models\VehicleType;
use Exception;
use PHPUnit\Framework\TestCase;
use Microservice\Domain\Exceptions\DomainCreateException;
use Tests\DomainFactory\VehicleTypeDomainFactory;

class VehicleTypeDomainTest extends TestCase
{

    public function testCreateDomain()
    {
        $vehicleType = VehicleTypeDomainFactory::create([
            'id' => 'uuid',
            'name' => 'name',
            'key' => 'key'
        ]);
        $this->assertEquals('uuid', $vehicleType->getUuid());
        $this->assertEquals('name', $vehicleType->getName()->value());
        $this->assertEquals('key', $vehicleType->getKey()->value());
    }

    public function testCreateDomainFailed()
    {
        $this->expectException(DomainCreateException::class);
        $this->expectExceptionMessage('Error trying to create a VehicleTypeDomain');
        VehicleTypeDomainFactory::create([
            'id' => 1,
            'name' => 'name',
            'key' => 'key'
        ]);
    }
}
