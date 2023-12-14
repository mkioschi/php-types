<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Information;

final class Gigabyte extends Information
{
    const NAME = 'Gigabyte';
    const PLURAL = 'Gigabytes';
    const SYMBOL = 'GB';

    public static function fromBytes(int|float $value): Gigabyte
    {
        return new Gigabyte(self::convertByteToGigabyte($value));
    }

    public static function innFromBytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Gigabyte(self::convertByteToGigabyte($value));
    }

    public function toBytes(): Byte
    {
        return Byte::fromGigabytes($this->value);
    }

    public static function fromKilobytes(int|float $value): Gigabyte
    {
        return new Gigabyte(self::convertKilobyteToGigabyte($value));
    }

    public static function innFromKilobytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Gigabyte(self::convertKilobyteToGigabyte($value));
    }

    public function toKilobytes(): Kilobyte
    {
        return Kilobyte::fromGigabytes($this->value);
    }

    public static function fromMegabytes(int|float $value): Gigabyte
    {
        return new Gigabyte(self::convertMegabyteToGigabyte($value));
    }

    public static function innFromMegabytes(int|float|null $value): ?Gigabyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Gigabyte(self::convertMegabyteToGigabyte($value));
    }

    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromGigabytes($this->value);
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
            Byte::class => self::convertByteToGigabyte($value->value),
            Kilobyte::class => self::convertKilobyteToGigabyte($value->value),
            Megabyte::class => self::convertMegabyteToGigabyte($value->value),
        };
    }
}
