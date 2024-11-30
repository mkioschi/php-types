<?php

namespace Mkioschi\Types\UnitOfMeasurement\Information;

final class Byte extends Information
{
    const NAME = 'Byte';
    const PLURAL = 'Bytes';
    const SYMBOL = 'B';

    public static function fromKilobytes(int|float $value): Byte
    {
        return new Byte(self::convertKilobyteToByte($value));
    }

    public static function innFromKilobytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte(self::convertKilobyteToByte($value));
    }

    public function toKilobytes(): Kilobyte
    {
        return Kilobyte::fromBytes($this->value);
    }

    public static function fromMegabytes(int|float $value): Byte
    {
        return new Byte(self::convertMegabyteToByte($value));
    }

    public static function innFromMegabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte(self::convertMegabyteToByte($value));
    }

    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromBytes($this->value);
    }

    public static function fromGigabytes(int|float $value): Byte
    {
        return new Byte(self::convertGigabyteToByte($value));
    }

    public static function innFromGigabytes(int|float|null $value): ?Byte
    {
        if (is_null($value)) {
            return null;
        }

        return new Byte(self::convertGigabyteToByte($value));
    }

    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromBytes($this->value);
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

    protected function normalize(Information|float|int $value): float|int
    {
        if (is_int($value) || is_float($value)) {
            return $value;
        }

        return match (get_class($value)) {
            Gigabyte::class => self::convertGigabyteToByte($value->value),
            Kilobyte::class => self::convertKilobyteToByte($value->value),
            Megabyte::class => self::convertMegabyteToByte($value->value),
        };
    }
}
