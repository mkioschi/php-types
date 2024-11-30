<?php

namespace Mkioschi\Types\UnitOfMeasurement\Information;

final class Megabyte extends Information
{
    const NAME = 'Megabyte';
    const PLURAL = 'Megabytes';
    const SYMBOL = 'MB';

    public static function fromBytes(int|float $value): Megabyte
    {
        return new Megabyte(self::convertByteToMegabyte($value));
    }

    public static function innFromBytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Megabyte(self::convertByteToMegabyte($value));
    }

    public function toBytes(): Byte
    {
        return Byte::fromMegabytes($this->value);
    }

    public static function fromKilobytes(int|float $value): Megabyte
    {
        return new Megabyte(self::convertKilobyteToMegabyte($value));
    }

    public static function innFromKilobytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Megabyte(self::convertKilobyteToMegabyte($value));
    }

    public function toKilobytes(): Kilobyte
    {
        return Kilobyte::fromMegabytes($this->value);
    }

    public static function fromGigabytes(int|float $value): Megabyte
    {
        return new Megabyte(self::convertGigabyteToMegabyte($value));
    }

    public static function innFromGigabytes(int|float|null $value): ?Megabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Megabyte(self::convertGigabyteToMegabyte($value));
    }

    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromMegabytes($this->value);
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
        return match (get_class($value)) {
            Byte::class => self::convertByteToMegabyte($value->value),
            Gigabyte::class => self::convertGigabyteToMegabyte($value->value),
            Kilobyte::class => self::convertKilobyteToMegabyte($value->value),
        };
    }
}
