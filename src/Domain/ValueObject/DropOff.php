<?php

declare(strict_types=1);

namespace Microservice\Domain\ValueObject;

use Microservice\Domain\Exceptions\DomainCreateException;
use Microservice\Domain\Shared\ValueObject\StringValueObject;

final class DropOff extends StringValueObject
{
    private string $name;
    private string $latitude;
    private string $longitude;

    public function __construct(string $data)
    {
        $pickUpdata = explode(":", $data);

        $this->name = $pickUpdata[0];
        $this->latitude = $pickUpdata[1];
        $this->longitude = $pickUpdata[2];

        $this->checkData();
    }

    public function getName()
    {
        return $this->name;
    }

    public function getLatitude()
    {
        return $this->latitude;
    }

    public function getLongitude()
    {
        return $this->longitude;
    }

    private function checkData()
    {

        if (empty($this->name) || empty($this->latitude) || empty($this->longitude)) {
            throw new DomainCreateException('Error trying to create a DropOff, some field is null');
        }
    }

    public function getConcatFormat()
    {
        return "$this->name:$this->latitude:$this->longitude";
    }
}
