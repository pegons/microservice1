<?php

declare(strict_types=1);

namespace Microservice\Infrastructure;

use App\Models\VehicleType;
use Microservice\Domain\Repositories\VehicleTypeRepositoryInterface;
use Microservice\Domain\VehicleTypeDomain;

class EloquentVehicleTypeRepository implements VehicleTypeRepositoryInterface
{
    /**
     * Create VehicleTypeDomain.
     *
     * @param VehicleTypeDomain $vehicleType
     *
     * @return VehicleTypeDomain
     */
    public function create(VehicleTypeDomain $vehicleType): VehicleTypeDomain
    {
        $model = VehicleType::create([
            'id' => (string)$vehicleType->getUuid(),
            'name' => $vehicleType->getName()->value(),
            'key' => $vehicleType->getKey()->value(),
        ]);
        return self::toDomain($model);
    }


    /**
     * Get VehicleType for vehicleTypeId.
     *
     * @param string $vehicleTypeId
     *
     * @return VehicleTypeDomain
     */
    public function find(string $vehicleTypeId): VehicleTypeDomain
    {
        return self::toDomain(VehicleType::where('id', $vehicleTypeId)
            ->firstOrFail());
    }


    /**
     * Mapper eloquent model to domain model.
     *
     * @param VehicleType $model
     *
     * @return VehicleTypeDomain
     */
    public static function toDomain(VehicleType $model): VehicleTypeDomain
    {
        return new VehicleTypeDomain([
            'id' => (string)$model->id,
            'name' => $model->name,
            'key' => $model->key,
            'createdAt' => $model->created_at
        ]);
    }
}
