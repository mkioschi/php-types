<?php declare(strict_types=1);

namespace Mkioschi\Types\PhoneNumber;

class Br implements PhoneNumberStandard
{
    private const AREA_CODES = ['11', '12', '13', '14', '15', '16', '17', '18', '19', '21', '22', '24', '27', '28', '31', '32', '33', '34', '35', '37', '38', '41', '42', '43', '44', '45', '46', '47', '48', '49', '51', '53', '54', '55', '61', '62', '63', '64', '65', '66', '67', '68', '69', '71', '73', '74', '75', '77', '79', '81', '82', '83', '84', '85', '86', '87', '88', '89', '91', '92', '93', '94', '95', '96', '97', '98', '99'];

    public function isValid(string $countryCode, string $areaCode, string $localNumber): bool
    {
        if ($countryCode !== '55') {
            return false;
        }

        if (!in_array($areaCode, self::AREA_CODES)) {
            return false;
        }

        if (!is_numeric($localNumber) || !in_array(strlen($localNumber), [8, 9])) {
            return false;
        }

        return true;
    }

    public function makeHumansFormat(string $countryCode, string $areaCode, string $localNumber): string
    {
        return sprintf(
            '+%s (%s) %s-%s',
            $countryCode,
            $areaCode,
            substr($localNumber, 0, -4),
            substr($localNumber, -4)
        );
    }

    public function makeHiddenFormat(string $countryCode, string $areaCode, string $localNumber, string $maskCharacter): string
    {
        $phoneNumber = $countryCode.$areaCode.$localNumber;
        return sprintf(
            '+%s%s%s',
            substr($phoneNumber, 0, 2),
            str_repeat($maskCharacter, strlen($phoneNumber) - 6),
            substr($phoneNumber, -4),
        );
    }
}