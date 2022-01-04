<?php

declare(strict_types=1);

namespace Microservice\Application\Services\Get;

use App\Dtos\GetRideServiceDto;
use Microservice\Application\Mappers\RideServiceMapper;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Application\Services\Get\GetRideServiceApplicationInterface;

class GetRideServiceApplication implements GetRideServiceApplicationInterface
{
    private RideServiceRepositoryInterface $rideServiceRepository;
    private RideServiceMapper $rideServiceMapper;

    public function __construct(
        RideServiceRepositoryInterface $rideServiceRepository,
        RideServiceMapper $rideServiceMapper
    ) {
        $this->rideServiceRepository = $rideServiceRepository;
        $this->rideServiceMapper = $rideServiceMapper;
    }

    /**
     * get a ride service from a id.
     *
     * @param string  $rideServiceId
     *
     * @return GetRideServiceDto
     */
    public function __invoke(string $rideServiceId): GetRideServiceDto
    {
        $rideServiceDomainModel = $this->rideServiceRepository->find($rideServiceId);

        return $this->rideServiceMapper->fromDomainToResponse($rideServiceDomainModel);
    }
}
