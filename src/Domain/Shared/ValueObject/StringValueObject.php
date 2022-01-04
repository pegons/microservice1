<?php

declare(strict_types=1);

namespace Microservice\Domain\Shared\ValueObject;

class StringValueObject
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }

    /**
     * Get value.
     *
     * @return string
     */
    public function value(): string
    {
        return $this->value;
    }

    /**
     * Get value in string.
     *
     * @return string
     */
    public function __toString(): string
    {
        return $this->value();
    }
}
