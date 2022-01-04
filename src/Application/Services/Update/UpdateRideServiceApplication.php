<?php

declare(strict_types=1);

namespace Microservice\Application\Services\Update;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PutRideServiceDto;
use Microservice\Application\Mappers\RideServiceMapper;
use Microservice\Application\Services\Update\UpdateRideServiceApplicationInterface;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Domain\Repositories\VehicleTypeRepositoryInterface;

class UpdateRideServiceApplication implements UpdateRideServiceApplicationInterface
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
     * Update a ride service from a dto.
     *
     * @param PutRideServiceDto $dto
     *
     * @return GetRideServiceDto
     */
    public function __invoke(PutRideServiceDto $dto): GetRideServiceDto
    {
        $vehicleTypeDomainModel = $this->vehicleTypeRepository->find($dto->vehicleType);

        $rideServiceDomainModel = $this->rideServiceMapper->fromPutToDomainModel($dto, $vehicleTypeDomainModel);


        $rideServiceDomainModel = $this->rideServiceRepository->update($rideServiceDomainModel);



        return $this->rideServiceMapper->fromDomainToResponse($rideServiceDomainModel);
    }
}
