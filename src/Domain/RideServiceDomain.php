<?php

declare(strict_types=1);

namespace Microservice\Domain;

use Throwable;
use Illuminate\Support\Str;
use Microservice\Domain\VehicleTypeDomain;
use Microservice\Domain\ValueObject\PickUp;
use Microservice\Domain\ValueObject\DropOff;
use Microservice\Domain\Shared\ValueObject\Uuid;
use Microservice\Domain\Exceptions\DomainCreateException;


final class RideServiceDomain
{
    private Uuid $id;
    private DropOff $dropOff;
    private PickUp $pickUp;
    private ?VehicleTypeDomain $vehicleType;
    private ?String $createdAt;

    public function __construct(array $param)
    {
        try {
            $this->id = !empty($param['id']) ? new Uuid($param['id']) : new Uuid((string)Str::uuid());
            $this->dropOff = new DropOff($param['dropOff']);
            $this->pickUp = new PickUp($param['pickUp']);
            $this->vehicleType = $param['vehicleType'];
            $this->createdAt = !empty($param['createdAt']) ? $param['createdAt'] : (string)now();
        } catch (Throwable $e) {
            throw new DomainCreateException("Error trying to create a RideServiceDomain");
        }
    }

    public function getUuid(): string
    {
        return $this->id->value();
    }

    public function getDropOff(): DropOff
    {
        return $this->dropOff;
    }

    public function getPickUp(): PickUp
    {
        return $this->pickUp;
    }

    public function getVehicleType(): ?VehicleTypeDomain
    {
        return $this->vehicleType;
    }

    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
}
