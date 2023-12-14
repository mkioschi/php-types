<?php declare(strict_types=1);

namespace Mkioschi\Types\Address;

class Generic implements AddressStandard
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
        return null;
    }
}