<?php

namespace Mkioschi\Types\Address\PostalCode;

interface PostalCodeStandard
{
    public static function isValid(string $value): bool;
}
