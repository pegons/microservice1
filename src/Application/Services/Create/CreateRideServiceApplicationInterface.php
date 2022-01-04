<?php

namespace Microservice\Application\Services\Create;

use App\Dtos\GetRideServiceDto;
use App\Dtos\PostRideServiceDto;

interface CreateRideServiceApplicationInterface
{
    public function __invoke(PostRideServiceDto $dto): GetRideServiceDto;
}
