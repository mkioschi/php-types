<?php

namespace Mkioschi\Types\Address\PostalCode;

use Mkioschi\Types\Str;

class Br implements PostalCodeStandard
{
    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (strlen($value) !== 9) {
            return false;
        }

        if (substr($value, 5, 1) !== '-') {
            return false;
        }

        $postalCode = Str::extractNumbers($value);

        if (strlen($postalCode) !== 8) {
            return false;
        }

        return is_numeric($postalCode);
    }
}