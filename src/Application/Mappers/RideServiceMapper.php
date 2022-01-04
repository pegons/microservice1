<?php

declare(strict_types=1);

namespace Microservice\Application\Mappers;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PostRideServiceDto;
use App\Dtos\PutRideServiceDto;
use Microservice\Domain\RideServiceDomain;
use Microservice\Domain\VehicleTypeDomain;

class RideServiceMapper
{
    /**
     * Create a domain from PostRideServiceDto and  VehicleTypeDomain.
     *
     * @param PostRideServiceDto $dto
     * @param VehicleTypeDomain $vehicleTypeDomain
     *
     * @return RideServiceDomain
     */
    public function toDomainModel(PostRideServiceDto $dto, VehicleTypeDomain $vehicleTypeDomain): RideServiceDomain
    {
        return new RideServiceDomain([
            'dropOff' => $dto->dropOff,
            'pickUp' => $dto->pickUp,
            'vehicleType' => $vehicleTypeDomain,
        ]);
    }

    /**
     * Update a domain from PutRideServiceDto and VehicleTypeDomain.
     *
     * @param PutRideServiceDto $dto
     * @param VehicleTypeDomain $vehicleTypeDomain
     *
     * @return RideServiceDomain
     */
    public function fromPutToDomainModel(PutRideServiceDto $dto, VehicleTypeDomain $vehicleTypeDomain): RideServiceDomain
    {
        return new RideServiceDomain([
            'id' => $dto->id,
            'dropOff' => $dto->dropOff,
            'pickUp' => $dto->pickUp,
            'vehicleType' => $vehicleTypeDomain,
        ]);
    }

    /**
     * Create a get dto from domain.
     *
     * @param RideServiceDomain $rideServiceDomain
     *
     * @return GetRideServiceDto
     */
    public function fromDomainToResponse(RideServiceDomain $rideServiceDomain): GetRideServiceDto
    {

        return new GetRideServiceDto([
            'id' => $rideServiceDomain->getUuid(),
            'dropOff' => $rideServiceDomain->getDropOff()->getConcatFormat(),
            'pickUp' => $rideServiceDomain->getPickUp()->getConcatFormat(),
            'vehicleTypeId' => $rideServiceDomain->getVehicleType()->getUuid(),
            'createdAt' => $rideServiceDomain->getCreatedAt()
        ]);
    }
}
