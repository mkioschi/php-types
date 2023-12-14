<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Weight;

final class Kilogram extends Weight
{
    const NAME = 'Kilogram';
    const PLURAL = 'Kilograms';
    const SYMBOL = 'kg';

    public static function fromGrams(float|int $value): Kilogram
    {
        return new Kilogram(self::convertGramToKilogram($value));
    }

    public static function innFromGrams(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram(self::convertGramToKilogram($value));
    }

    public function toGrams(): Gram
    {
        return Gram::fromKilograms($this->value);
    }

    public static function fromPounds(float|int $value): Kilogram
    {
        return new Kilogram(self::convertPoundToKilogram($value));
    }

    public static function innFromPounds(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram(self::convertPoundToKilogram($value));
    }

    public function toPounds(): Pound
    {
        return Pound::fromKilograms($this->value);
    }

    public static function fromOunces(float|int $value): Kilogram
    {
        return new Kilogram(self::convertOunceToKilogram($value));
    }

    public static function innFromOunces(float|int|null $value): ?Kilogram
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilogram(self::convertOunceToKilogram($value));
    }

    public function toOunces(): Ounce
    {
        return Ounce::fromKilograms($this->value);
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
            Gram::class => self::convertGramToKilogram($value->value),
            Kilogram::class => $value->value,
            Ounce::class => self::convertOunceToKilogram($value->value),
            Pound::class => self::convertPoundToKilogram($value->value),
        };
    }
}
