<?php

namespace Mkioschi\Types\UnitOfMeasurement;

use Mkioschi\Enums\Locale;
use Mkioschi\Types\Numeric;
use Exception;

abstract class UnitOfMeasurement
{
    public static Locale $defaultLocale = Locale::EN_US;

    public readonly float|int $value;

    abstract public static function getSymbol(): string;

    abstract public static function getName(): string;

    abstract public static function getPlural(): string;

    protected function __construct(float|int $value)
    {
        $this->value = $value;
    }

    public static function resetDefaults(): void
    {
        self::$defaultLocale = Locale::EN_US;
    }

    public static function from(float|int $value): static
    {
        return new static($value);
    }

    public static function tryFrom(float|int $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    public static function innFrom(float|int|null $value): ?static
    {
        if (is_null($value)) {
            return null;
        }

        return new static($value);
    }

    public static function fromZero(): static
    {
        return new static(0);
    }

    public static function init(): static
    {
        return static::fromZero();
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function getHumansFormat(bool $abbreviated = true, int $maxDecimalPlaces = 2, ?Locale $locale = null): string
    {
        return self::formatForHumans($this->value, $abbreviated, $maxDecimalPlaces, $locale ?? self::$defaultLocale);
    }

    public static function formatForHumans(
        float|int $value,
        bool $abbreviated = true,
        int $maxDecimalPlaces = 2,
        ?Locale $locale = null
    ): string
    {
        $locale = $locale ?? self::$defaultLocale;

        $handledValue = (float)Numeric::numberFormat($value, $maxDecimalPlaces);

        if ($locale === Locale::PT_BR) {
            $handledValue = str_replace('.', ',', (string)$handledValue);
        }

        if ($abbreviated) {
            return sprintf('%s %s', $handledValue, static::getSymbol());
        }

        if ($handledValue >= 1 && $handledValue < 2) {
            return sprintf('%s %s', $handledValue, strtolower(static::getName()));
        }

        return sprintf('%s %s', $handledValue, strtolower(static::getPlural()));
    }
}
