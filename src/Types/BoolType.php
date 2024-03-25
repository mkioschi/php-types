<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Throwable;

final readonly class BoolType
{
    public bool $value;

    protected function __construct(bool $value)
    {
        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_bool($value);
    }

    public static function from(bool $value): BoolType
    {
        return new BoolType($value);
    }

    public static function fromTrue(): BoolType
    {
        return new BoolType(true);
    }

    public static function fromFalse(): BoolType
    {
        return new BoolType(false);
    }

    public static function tryFrom(mixed $value): ?BoolType
    {
        try {
            return new BoolType($value);
        } catch (Throwable) {
            return null;
        }
    }

    public static function innFrom(mixed $value): ?BoolType
    {
        if (is_null($value)) {
            return null;
        }

        return new BoolType($value);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function fromString(string $value): BoolType
    {
        $filteredValue = filter_var($value, FILTER_VALIDATE_BOOLEAN, FILTER_NULL_ON_FAILURE);

        if (!BoolType::isValid($filteredValue)) {
            throw new InvalidTypeException("Invalid truthy or falsy string.");
        }

        return new BoolType($filteredValue);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function innFromString(?string $value): ?BoolType
    {
        if (is_null($value)) return null;
        return BoolType::fromString($value);
    }

    public function __toString(): string
    {
        return $this->value ? 'true' : 'false';
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    public function isTrue(): bool
    {
        return $this->value === true;
    }

    public function isFalse(): bool
    {
        return $this->value === false;
    }
}
