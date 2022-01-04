<?php

namespace Microservice\Application\Services\Update;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PutRideServiceDto;

interface UpdateRideServiceApplicationInterface
{
    public function __invoke(PutRideServiceDto $dto): GetRideServiceDto;
}
