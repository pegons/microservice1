<?php

namespace Tests\Integration;

use App\Models\VehicleType;
use Microservice\Infrastructure\EloquentRideServiceRepository;
use Microservice\Infrastructure\EloquentVehicleTypeRepository;
use Tests\DomainFactory\RideServiceDomainFactory;
use Tests\IntegrationTestCase;

class EloquentRideServiceRepositoryTest extends IntegrationTestCase
{
    private EloquentRideServiceRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = resolve(EloquentRideServiceRepository::class);
    }

    public function testCreate()
    {
        $model = VehicleType::first();
        $vehicleType = EloquentVehicleTypeRepository::toDomain($model);


        $assignmentRuleAttributeType = RideServiceDomainFactory::create([
            'vehicleType' => $vehicleType
        ]);

        $result = $this->repository->create($assignmentRuleAttributeType);
        $this->assertEquals($assignmentRuleAttributeType, $result);
    }

    public function testFind()
    {
        $model = VehicleType::first();
        $vehicleType = EloquentVehicleTypeRepository::toDomain($model);


        $assignmentRuleAttributeType = RideServiceDomainFactory::create([
            'vehicleType' => $vehicleType
        ]);

        $domainToCreate = $this->repository->create($assignmentRuleAttributeType);

        $domainToFind = $this->repository->find($domainToCreate->getUuid());
        $this->assertEquals($domainToCreate, $domainToFind);
    }
}
