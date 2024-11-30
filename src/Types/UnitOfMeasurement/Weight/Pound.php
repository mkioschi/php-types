<?php

namespace Mkioschi\Types\UnitOfMeasurement\Weight;

final class Pound extends Weight
{
    const NAME = 'Pound';
    const PLURAL = 'Pounds';
    const SYMBOL = 'lbs';

    public static function fromKilograms(float|int $value): Pound
    {
        return new Pound(self::convertKilogramToPound($value));
    }

    public static function innFromKilograms(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound(self::convertKilogramToPound($value));
    }

    public function toKilograms(): Kilogram
    {
        return Kilogram::fromPounds($this->value);
    }

    public static function fromGrams(float|int $value): Pound
    {
        return new Pound(self::convertGramToPound($value));
    }

    public static function innFromGrams(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound(self::convertGramToPound($value));
    }

    public function toGrams(): Gram
    {
        return Gram::fromPounds($this->value);
    }

    public static function fromOunces(float|int $value): Pound
    {
        return new Pound(self::convertOunceToPound($value));
    }

    public static function innFromOunces(float|int|null $value): ?Pound
    {
        if (is_null($value)) {
            return null;
        }

        return new Pound(self::convertOunceToPound($value));
    }

    public function toOunces(): Ounce
    {
        return Ounce::fromPounds($this->value);
    }

    public static function getSymbol(): string
    {
        return self::SYMBOL;
    }

    public static function getName(): string
    {
        return self::NAME;
    }

    public static function getPlural(): string
    {
        return self::PLURAL;
    }

    protected function normalize(Weight|float|int $value): float|int
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        return match (get_class($value)) {
            Gram::class => self::convertGramToPound($value->value),
            Kilogram::class => self::convertKilogramToPound($value->value),
            Ounce::class => self::convertOunceToPound($value->value),
            Pound::class => $value->value,
        };
    }
}
