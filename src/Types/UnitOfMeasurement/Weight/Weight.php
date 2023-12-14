<?php declare(strict_types=1);

namespace Mkioschi\Types\UnitOfMeasurement\Weight;

use Mkioschi\Types\UnitOfMeasurement\UnitOfMeasurement;

abstract class Weight extends UnitOfMeasurement
{
    abstract protected function normalize(float|int|self $value): float|int;

    public function sum(float|int|self $value): static
    {
        return new static(
            value: $this->value + $this->normalize($value)
        );
    }

    public function minus(float|int|self $value): static
    {
        return new static(
            value: $this->value - $this->normalize($value)
        );
    }

    public function multiply(float|int $multiplier): static
    {
        return new static(
            value: $this->value * $multiplier
        );
    }

    public function divide(float|int $divisor): static
    {
        return new static(
            value: $this->value / $divisor
        );
    }

    public function percentage(float|int $ratio): static
    {
        return new static(
            value: $this->value / 100 * $ratio
        );
    }

    public function sumPercentage(float|int $ratio): static
    {
        return new static(
            value: $this->value + ($this->value / 100 * $ratio)
        );
    }

    public function minusPercentage(float|int $ratio): static
    {
        return new static(
            value: $this->value - ($this->value / 100 * $ratio)
        );
    }

    public function percentageRatio(float|int|self $value): float|int
    {
        return $this->normalize($value) / $this->value * 100;
    }

    protected static function convertGramToKilogram(float|int $grams): float|int
    {
        return $grams / 1000;
    }

    protected static function convertGramToOunce(float|int $grams): float|int
    {
        return $grams * 0.0352739619;
    }

    protected static function convertGramToPound(float|int $grams): float|int
    {
        return $grams / 453.59237;
    }

    protected static function convertKilogramToGram(float|int $kilograms): float|int
    {
        return $kilograms * 1000;
    }

    protected static function convertKilogramToOunce(float|int $kilograms): float|int
    {
        return $kilograms * 35.2739619496;
    }

    protected static function convertKilogramToPound(float|int $kilograms): float|int
    {
        return $kilograms * 2.2046226218;
    }

    protected static function convertOunceToGram(float|int $ounces): float|int
    {
        return $ounces * 28.349523125;
    }

    protected static function convertOunceToKilogram(float|int $ounces): float|int
    {
        return $ounces * 0.0283495231;
    }

    protected static function convertOunceToPound(float|int $ounces): float|int
    {
        return $ounces / 16;
    }

    protected static function convertPoundToGram(float|int $pounds): float|int
    {
        return $pounds * 453.59237;
    }

    protected static function convertPoundToKilogram(float|int $pounds): float|int
    {
        return $pounds * 0.45359237;
    }

    protected static function convertPoundToOunce(float|int $pounds): float|int
    {
        return $pounds * 16;
    }
}