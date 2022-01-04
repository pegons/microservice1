<?php

declare(strict_types=1);

namespace Microservice\Domain\Shared\ValueObject;

use InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;

class Uuid
{
    private ?string $value;

    public function __construct(?string $value = null, $generateUuid = false)
    {
        if ($generateUuid) {
            $value = $value ?? self::random()->value();
            $this->ensureIsValidUuid($value);
        }

        $this->value = $value;
    }

    public static function random(): self
    {
        return new self(RamseyUuid::uuid4()->toString());
    }

    public function value(): string
    {
        return $this->value;
    }

    /**
     * Compare two Uuid objects value.
     *
     * @param Uuid $another
     *
     * @return bool
     */
    public function equal(self $another): bool
    {
        return $this->value === $another->value();
    }

    private function ensureIsValidUuid($id): void
    {
        if (!RamseyUuid::isValid($id)) {
            throw new InvalidArgumentException(sprintf('<%s> does not allow the value <%s>.', static::class, $id));
        }
    }

    public function __toString(): string
    {
        return $this->value();
    }
}
