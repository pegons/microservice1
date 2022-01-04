<?php

declare(strict_types=1);

namespace Microservice\Application\Services\Create;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PostRideServiceDto;
use Microservice\Application\Mappers\RideServiceMapper;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Domain\Repositories\VehicleTypeRepositoryInterface;
use Microservice\Application\Services\Create\CreateRideServiceApplicationInterface;

class CreateRideServiceApplication implements CreateRideServiceApplicationInterface
{
    private RideServiceRepositoryInterface $rideServiceRepository;
    private VehicleTypeRepositoryInterface $vehicleTypeRepository;
    private RideServiceMapper $rideServiceMapper;

    public function __construct(
        RideServiceRepositoryInterface $rideServiceRepository,
        VehicleTypeRepositoryInterface $vehicleTypeRepository,
        RideServiceMapper $rideServiceMapper
    ) {
        $this->rideServiceRepository = $rideServiceRepository;
        $this->vehicleTypeRepository = $vehicleTypeRepository;
        $this->rideServiceMapper = $rideServiceMapper;
    }

    /**
     * Create a ride service from a dto.
     *
     * @param PostRideServiceDto $dto
     *
     * @return GetRideServiceDto
     */
    public function __invoke(PostRideServiceDto $dto): GetRideServiceDto
    {
        $vehicleTypeDomainModel = $this->vehicleTypeRepository->find($dto->vehicleType);

        $rideServiceDomainModel = $this->rideServiceMapper->toDomainModel($dto, $vehicleTypeDomainModel);

        $this->rideServiceRepository->create($rideServiceDomainModel);

        return $this->rideServiceMapper->fromDomainToResponse($rideServiceDomainModel);
    }
}
