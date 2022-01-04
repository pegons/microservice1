<?php

declare(strict_types=1);

namespace Microservice\Domain\Repositories;

use App\Models\VehicleType;
use Microservice\Domain\VehicleTypeDomain;

interface VehicleTypeRepositoryInterface
{
    public function create(VehicleTypeDomain $vehicleType): VehicleTypeDomain;

    public function find(string $vehicleTypeId): VehicleTypeDomain;

    public static function toDomain(VehicleType $model): VehicleTypeDomain;
}
