<?php

declare(strict_types=1);

namespace Microservice\Domain\Repositories;

use App\Models\RideService;
use Microservice\Domain\RideServiceDomain;

interface RideServiceRepositoryInterface
{
    public function create(RideServiceDomain $rideService): RideServiceDomain;

    public function find(string $rideServiceId): RideServiceDomain;

    public static function toDomain(RideService $model): RideServiceDomain;

    public function update(RideServiceDomain $rideService): RideServiceDomain;
}
