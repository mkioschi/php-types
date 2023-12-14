<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Weight;

final class Ounce extends Weight
{
    const NAME = 'Ounce';
    const PLURAL = 'Ounces';
    const SYMBOL = 'oz';

    public static function fromKilograms(float|int $value): Ounce
    {
        return new Ounce(self::convertKilogramToOunce($value));
    }

    public static function innFromKilograms(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce(self::convertKilogramToOunce($value));
    }

    public function toKilograms(): Kilogram
    {
        return Kilogram::fromOunces($this->value);
    }

    public static function fromGrams(float|int $value): Ounce
    {
        return new Ounce(self::convertGramToOunce($value));
    }

    public static function innFromGrams(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce(self::convertGramToOunce($value));
    }

    public function toGrams(): Gram
    {
        return Gram::fromOunces($this->value);
    }

    public static function fromPounds(float|int $value): Ounce
    {
        return new Ounce(self::convertPoundToOunce($value));
    }

    public static function innFromPounds(float|int|null $value): ?Ounce
    {
        if (is_null($value)) {
            return null;
        }

        return new Ounce(self::convertPoundToOunce($value));
    }

    public function toPounds(): Pound
    {
        return Pound::fromOunces($this->value);
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
            Gram::class => self::convertGramToOunce($value->value),
            Kilogram::class => self::convertKilogramToOunce($value->value),
            Ounce::class => $value->value,
            Pound::class => self::convertPoundToOunce($value->value),
        };
    }
}
