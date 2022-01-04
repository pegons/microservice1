<?php

namespace Microservice\Application\Services\Get;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PostRideServiceDto;

interface GetRideServiceApplicationInterface
{
    public function __invoke(string $rideServiceId): GetRideServiceDto;
}
