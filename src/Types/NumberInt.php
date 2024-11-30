<?php

namespace Mkioschi\Types;

use Exception;

final class NumberInt
{
    public readonly int $value;

    protected function __construct(int $value)
    {
        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value);
    }

    public static function from(int $value): NumberInt
    {
        return new NumberInt($value);
    }

    public static function tryFrom(int $value): ?NumberInt
    {
        try {
            return new NumberInt($value);
        } catch (Exception) {
            return null;
        }
    }

    public static function innFrom(int|null $value): ?NumberInt
    {
        if (is_null($value)) {
            return null;
        }

        return new NumberInt($value);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function equals(int|NumberInt $value): bool
    {
        if (is_int($value)) {
            return $this->value === $value;
        }

        return $this->value === $value->value;
    }
}