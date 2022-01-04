<?php

namespace Tests\Integration;

use App\Models\VehicleType;
use Illuminate\Support\Str;
use Microservice\Infrastructure\EloquentRideServiceRepository;
use Microservice\Infrastructure\EloquentVehicleTypeRepository;
use Tests\DomainFactory\RideServiceDomainFactory;
use Tests\IntegrationTestCase;

class EloquentVehicleTypeRepositoryTest extends IntegrationTestCase
{
    private EloquentVehicleTypeRepository $repository;

    public function setUp(): void
    {
        parent::setUp();

        $this->repository = resolve(EloquentVehicleTypeRepository::class);
    }

    public function testCreate()
    {
        $model = new VehicleType([
            'id' => (string) Str::uuid(),
            'name' => 'testName',
            'key' => 'testKeY',
            'created_at' => (string)now(),
            'updated_at' => (string)now()
        ]);

        $domainModel = EloquentVehicleTypeRepository::toDomain($model);
        $result = $this->repository->create($domainModel);
        $this->assertEquals($domainModel, $result);
    }

    public function testFind()
    {
        $model = new VehicleType([
            'id' => (string) Str::uuid(),
            'name' => 'testName',
            'key' => 'testKeY',
            'created_at' => (string)now(),
            'updated_at' => (string)now()
        ]);

        $domainModel = EloquentVehicleTypeRepository::toDomain($model);
        $domainToCreate = $this->repository->create($domainModel);

        $domainToFind = $this->repository->find($domainToCreate->getUuid());
        $this->assertEquals($domainToCreate, $domainToFind);
    }
}
