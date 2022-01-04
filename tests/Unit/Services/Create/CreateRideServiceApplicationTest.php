<?php

namespace Tests\Unit\Services\Create;

use Mockery;
use Tests\UnitTestCase;
use App\Dtos\GetRideServiceDto;
use App\Dtos\PostRideServiceDto;
use Tests\DomainFactory\RideServiceDomainFactory;
use Tests\DomainFactory\VehicleTypeDomainFactory;
use Microservice\Application\Mappers\RideServiceMapper;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Domain\Repositories\VehicleTypeRepositoryInterface;
use Microservice\Application\Services\Create\CreateRideServiceApplication;

class CreateRideServiceApplicationTest extends UnitTestCase
{
    private CreateRideServiceApplication $applicationService;
    private RideServiceRepositoryInterface $rideServiceRepository;
    private VehicleTypeRepositoryInterface $vehicleTypeRepository;
    private RideServiceMapper $rideServiceMapper;


    public function setUp(): void
    {
        parent::setUp();
        $this->rideServiceRepository = Mockery::mock(
            RideServiceRepositoryInterface::class
        );

        $this->vehicleTypeRepository = Mockery::mock(
            VehicleTypeRepositoryInterface::class
        );

        $this->rideServiceMapper = Mockery::mock(
            RideServiceMapper::class
        );

        $this->applicationService =
            new CreateRideServiceApplication(
                $this->rideServiceRepository,
                $this->vehicleTypeRepository,
                $this->rideServiceMapper,
            );
    }

    public function testCreateRideServiceApplication()
    {

        $postDto = new PostRideServiceDto([
            'pickUp' => 'pickUp',
            'dropOff' => 'dropOff',
            'vehicleType' => 'uuid'
        ]);
        $getDto = Mockery::mock(GetRideServiceDto::class);
        $vehicleTypeDomainModel = VehicleTypeDomainFactory::create();
        $rideServiceDomainModel = RideServiceDomainFactory::create([
            'vehicleType' => $vehicleTypeDomainModel
        ]);

        $this->vehicleTypeRepository->shouldReceive('find')
            ->once()
            ->with($postDto->vehicleType)
            ->andReturn($vehicleTypeDomainModel);

        $this->rideServiceMapper->shouldReceive('toDomainModel')
            ->once()
            ->with($postDto, $vehicleTypeDomainModel)
            ->andReturn($rideServiceDomainModel);

        $this->rideServiceRepository->shouldReceive('create')
            ->once()
            ->with($rideServiceDomainModel)
            ->andReturn($rideServiceDomainModel);

        $this->rideServiceMapper->shouldReceive('fromDomainToResponse')
            ->once()
            ->with($rideServiceDomainModel)
            ->andReturn($getDto);

        $this->applicationService->__invoke($postDto);
    }
}
