<?php declare(strict_types=1);

namespace Mkioschi\Types\Address\PostalCode;

use Exception;
use Mkioschi\Enums\Country;
use Mkioschi\Types\InvalidTypeException;

final class PostalCode
{
    public readonly string $value;
    public readonly Country $country;
    private PostalCodeStandard $postalCodeStandard;

    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value, Country $country)
    {
        $this->postalCodeStandard = self::buildStandardByCountry($country);

        if (!$this->postalCodeStandard->isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid PostalCode type.', $value));
        }

        $this->value = $value;
        $this->country = $country;
    }

    public static function isValid(mixed $value, Country $country): bool
    {
        $postalCodeStandard = self::buildStandardByCountry($country);
        return $postalCodeStandard->isValid($value);
    }

    private static function buildStandardByCountry(Country $country): PostalCodeStandard
    {
        return match ($country) {
            Country::BRAZIL => new Br,
            default => new Generic,
        };
    }

    /**
     * @throws InvalidTypeException
     */
    public static function from(string $value, Country $country): PostalCode
    {
        return new PostalCode($value, $country);
    }

    public static function tryFrom(string $value, Country $country): ?PostalCode
    {
        try {
            return new PostalCode($value, $country);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeException
     */
    public static function innFrom(?string $value, ?Country $country): ?PostalCode
    {
        if (is_null($value) || is_null($country)) {
            return null;
        }

        return new PostalCode($value, $country);
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
