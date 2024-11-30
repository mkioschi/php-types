<?php

namespace Mkioschi\Types\UnitOfMeasurement\Information;

use Mkioschi\Types\UnitOfMeasurement\UnitOfMeasurement;

abstract class Information extends UnitOfMeasurement
{
    abstract protected function normalize(float|int|self $value): float|int;

    public function sum(float|int|self $value): static
    {
        return new static(
            value: $this->value + $this->normalize($value)
        );
    }

    protected static function convertByteToGigabyte(float|int $byte): float|int
    {
        return $byte / 1024 / 1024 / 1024;
    }

    protected static function convertByteToKilobyte(float|int $byte): float|int
    {
        return $byte / 1024;
    }

    protected static function convertByteToMegabyte(float|int $byte): float|int
    {
        return $byte / 1024 / 1024;
    }

    protected static function convertGigabyteToByte(float|int $gigabyte): float|int
    {
        return $gigabyte * 1024 * 1024 * 1024;
    }

    protected static function convertGigabyteToKilobyte(float|int $gigabyte): float|int
    {
        return $gigabyte * 1024 * 1024;
    }

    protected static function convertGigabyteToMegabyte(float|int $gigabyte): float|int
    {
        return $gigabyte * 1024;
    }

    protected static function convertKilobyteToByte(float|int $kilobyte): float|int
    {
        return $kilobyte * 1024;
    }

    protected static function convertKilobyteToGigabyte(float|int $kilobyte): float|int
    {
        return $kilobyte / 1024 / 1024;
    }

    protected static function convertKilobyteToMegabyte(float|int $kilobyte): float|int
    {
        return $kilobyte / 1024;
    }

    protected static function convertMegabyteToByte(float|int $megabyte): float|int
    {
        return $megabyte * 1024 * 1024;
    }

    protected static function convertMegabyteToGigabyte(float|int $megabyte): float|int
    {
        return $megabyte / 1024;
    }

    protected static function convertMegabyteToKilobyte(float|int $megabyte): float|int
    {
        return $megabyte * 1024;
    }
}