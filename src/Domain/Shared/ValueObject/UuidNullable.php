<?php

declare(strict_types=1);

namespace Microservice\Domain\Shared\ValueObject;


use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class UuidNullable
{
    private ?string $value;

    public function __construct(?string $value)
    {
        if ($value) {
            $this->ensureIsValidUuid($value);
        }

        $this->value = $value;
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): ?string
    {
        return $this->value;
    }

    private function ensureIsValidUuid($id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }
}
