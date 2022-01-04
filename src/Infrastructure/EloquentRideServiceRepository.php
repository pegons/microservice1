<?php

declare(strict_types=1);

namespace Microservice\Infrastructure;

use App\Models\RideService;
use App\Models\VehicleType;
use Microservice\Domain\Repositories\RideServiceRepositoryInterface;
use Microservice\Domain\RideServiceDomain;


class EloquentRideServiceRepository implements RideServiceRepositoryInterface
{
    /**
     * Create RideService.
     *
     * @param RideServiceDomain $rideService
     *
     * @return RideServiceDomain
     */
    public function create(RideServiceDomain $rideService): RideServiceDomain
    {

        $result = RideService::create([
            'id' => $rideService->getUuid(),
            'pick_up' => $rideService->getPickUp()->getConcatFormat(),
            'drop_off' => $rideService->getDropOff()->getConcatFormat(),
            'vehicle_type_id' => $rideService->getVehicleType()->getUuid(),
            'created_at' => (string)now(),
            'updated_at' => (string)now()
        ]);

        return self::toDomain($result);
    }

    /**
     * Find RideService.
     *
     * @param string $rideServiceId
     *
     * @return RideServiceDomain
     */
    public function find(string $rideServiceId): RideServiceDomain
    {
        $result = RideService::findOrFail($rideServiceId);
        return self::toDomain($result);
    }

    /**
     * Update RideService.
     *
     * @param RideServiceDomain $rideService
     *
     * @return bool
     */
    public function update(RideServiceDomain $rideService): RideServiceDomain
    {
        $rideServiceId = (string)$rideService->getUuid();

        return $this->toDomain(
            tap(RideService::findOrFail($rideServiceId), function ($eloquentRideService) use ($rideService) {
                $eloquentRideService->update([
                    'id' => $rideService->getUuid(),
                    'pick_up' => $rideService->getPickUp()->getConcatFormat(),
                    'drop_off' => $rideService->getDropOff()->getConcatFormat(),
                    'vehicle_type_id' => $rideService->getVehicleType()->getUuid(),
                    'updated_at' => (string)now()
                ]);
            })
        );
    }


    /**
     * Mapper eloquent model to domain model.
     *
     * @param RideService $model
     *
     * @return RideServiceDomain
     */
    public static function toDomain(RideService $model): RideServiceDomain
    {

        $vehicleType = EloquentVehicleTypeRepository::toDomain(
            VehicleType::where('id', $model->vehicle_type_id)->first()
        );

        return new RideServiceDomain([
            'id' => $model->id,
            'dropOff' => $model->drop_off,
            'pickUp' => $model->pick_up,
            'vehicleType' => $vehicleType,
        ]);
    }
}
