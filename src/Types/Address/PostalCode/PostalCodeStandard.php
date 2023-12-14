<?php declare(strict_types=1);

namespace Mkioschi\Types\Address\PostalCode;

interface PostalCodeStandard
{
    public static function isValid(string $value): bool;
}
