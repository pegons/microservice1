<?php

declare(strict_types=1);

namespace Microservice\Domain;

use Throwable;
use Microservice\Domain\Shared\ValueObject\Uuid;
use Microservice\Domain\Exceptions\DomainCreateException;
use Microservice\Domain\Shared\ValueObject\StringValueObject;

final class VehicleTypeDomain
{
    private Uuid $id;
    private StringValueObject $key;
    private StringValueObject $name;
    /**
     * Create a new VehicleTypeDomain with params
     * ['(String)id', '(String)key', '(String)name']
     *
     * @param array $params
     * @return void
     */

    public function __construct(array $params)
    {
        try {
            $this->id = new Uuid($params['id']);
            $this->key = new StringValueObject($params['key']);
            $this->name = new StringValueObject($params['name']);
        } catch (Throwable $e) {
            throw new DomainCreateException("Error trying to create a VehicleTypeDomain");
        }
    }

    public function getUuid(): string
    {
        return $this->id->value();
    }

    public function getName(): StringValueObject
    {
        return $this->name;
    }

    public function getKey(): StringValueObject
    {
        return $this->key;
    }
}
