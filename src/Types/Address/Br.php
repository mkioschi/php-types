<?php

namespace Mkioschi\Types\Address;

use Mkioschi\Enums\Country;
use Mkioschi\Types\Address\PostalCode\PostalCode;

class Br implements AddressStandard
{
    public static function validator(
        string $addressLine1,
        ?string $addressLine2 = null,
        ?string $dependentLocality = null,
        ?string $locality = null,
        ?string $adminArea = null,
        ?string $postalCode = null,
        ?string $poBox = null
    ): ?array
    {
        if (is_null($dependentLocality)) {
            $errors[] = 'Invalid dependent locality.';
        }

        if (is_null($locality)) {
            $errors[] = 'Invalid locality.';
        }

        if (is_null($adminArea)) {
            $errors[] = 'Invalid admin area.';
        }

        if (!PostalCode::isValid($postalCode, Country::BRAZIL)) {
            $errors[] = 'Invalid Postal Code.';
        }

        return $errors ?? null;
    }
}