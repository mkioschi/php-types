<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Information;

final class Kilobyte extends Information
{
    const NAME = 'Kilobyte';
    const PLURAL = 'Kilobytes';
    const SYMBOL = 'KB';

    public static function fromBytes(int|float $value): Kilobyte
    {
        return new Kilobyte(self::convertByteToKilobyte($value));
    }

    public static function innFromBytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte(self::convertByteToKilobyte($value));
    }

    public function toBytes(): Byte
    {
        return Byte::fromKilobytes($this->value);
    }

    public static function fromMegabytes(int|float $value): Kilobyte
    {
        return new Kilobyte(self::convertMegabyteToKilobyte($value));
    }

    public static function innFromMegabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte(self::convertMegabyteToKilobyte($value));
    }

    public function toMegabytes(): Megabyte
    {
        return Megabyte::fromKilobytes($this->value);
    }

    public static function fromGigabytes(int|float $value): Kilobyte
    {
        return new Kilobyte(self::convertGigabyteToKilobyte($value));
    }

    public static function innFromGigabytes(int|float|null $value): ?Kilobyte
    {
        if (is_null($value)) {
            return null;
        }

        return new Kilobyte(self::convertGigabyteToKilobyte($value));
    }

    public function toGigabytes(): Gigabyte
    {
        return Gigabyte::fromKilobytes($this->value);
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
            Byte::class => self::convertByteToKilobyte($value->value),
            Gigabyte::class => self::convertGigabyteToKilobyte($value->value),
            Megabyte::class => self::convertMegabyteToKilobyte($value->value),
        };
    }
}
