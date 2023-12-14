<?php declare(strict_types=1);

namespace Mkioschi\Types\PhoneNumber;

interface PhoneNumberStandard
{
    public function isValid(
        string $countryCode,
        string $areaCode,
        string $localNumber
    ): bool;

    public function makeHumansFormat(
        string $countryCode,
        string $areaCode,
        string $localNumber
    ): string;

    public function makeHiddenFormat(
        string $countryCode,
        string $areaCode,
        string $localNumber,
        string $maskCharacter
    ): string;
}