<?php

namespace Mkioschi\Types\UnitOfMeasurement\Length;

final class Centimeter extends Length
{
    const NAME = 'Centimeter';
    const PLURAL = 'Centimeters';
    const SYMBOL = 'cm';

    public static function fromMillimeters(int|float $value): Centimeter
    {
        return new Centimeter($value / 10);
    }

    public static function innFromMillimeters(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) {
            return null;
        }

        return new Centimeter($value / 10);
    }

    public function toMillimeters(): int|float
    {
        return $this->value * 10;
    }

    public static function fromMeters(int|float $value): Centimeter
    {
        return new Centimeter($value * 100);
    }

    public static function innFromMeters(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) {
            return null;
        }

        return new Centimeter($value * 100);
    }

    public function toMeters(): int|float
    {
        return $this->value / 100;
    }

    public static function fromInches(int|float $value): Centimeter
    {
        return new Centimeter($value * 2.54);
    }

    public static function innFromInches(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) {
            return null;
        }

        return new Centimeter($value * 2.54);
    }

    public function toInches(): int|float
    {
        return $this->value / 2.54;
    }

    public static function fromFeet(int|float $value): Centimeter
    {
        return new Centimeter($value * 30.48);
    }

    public static function innFromFeet(int|float|null $value): ?Centimeter
    {
        if (is_null($value)) {
            return null;
        }

        return new Centimeter($value * 30.48);
    }

    public function toFeet(): int|float
    {
        return $this->value / 30.48;
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

    protected function normalize(Length|float|int $value): float|int
    {
        // TODO: Implement normalize() method.
    }
}
