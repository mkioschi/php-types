<?php declare(strict_types=1);

namespace Mkioschi\Types\PhoneNumber;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;
use Exception;

/**
 * Phone Number
 *
 * The phone number must have the following format "<country-code> <area-code> <local-number>"
 * For example: 55 44 36243639
 *  - 55 is an International Country code;
 *  - 44 is an Area code;
 *  - and 36243639 is a Local number.
 */
final class PhoneNumber
{
    public readonly string $value;
    public readonly string $countryCode;
    public readonly string $areaCode;
    public readonly string $localNumber;
    private PhoneNumberStandard $standardPhoneNumber;

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        $valueExploded = explode(' ', $value);

        if (count($valueExploded) < 3) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Phone Number.', $value));
        }

        $this->countryCode = Str::extractNumbers(array_shift($valueExploded));
        $this->areaCode = Str::extractNumbers(array_shift($valueExploded));
        $this->localNumber = Str::extractNumbers(join($valueExploded));
        $this->standardPhoneNumber = $this->buildStandardPhoneNumber($this->countryCode);

        if (!$this->standardPhoneNumber->isValid($this->countryCode, $this->areaCode, $this->localNumber)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Phone Number.', $value));
        }

        $this->value = sprintf(
            '%s %s %s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    public static function isValid(string $value): bool
    {
        $valueExploded = explode(' ', $value);

        if (count($valueExploded) < 3) {
            return false;
        }

        $countryCode = Str::extractNumbers(array_shift($valueExploded));
        $areaCode = Str::extractNumbers(array_shift($valueExploded));
        $localNumber = Str::extractNumbers(join($valueExploded));
        $standardPhoneNumber = self::buildStandardPhoneNumber($countryCode);

        return $standardPhoneNumber->isValid($countryCode, $areaCode, $localNumber);
    }

    private static function buildStandardPhoneNumber(string $countryCode): PhoneNumberStandard
    {
        return match ($countryCode) {
            '1' => new Us,
            '55' => new Br,
            default => new Generic,
        };
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function from(string $value): PhoneNumber
    {
        return new PhoneNumber($value);
    }

    public static function tryFrom(string $value): ?PhoneNumber
    {
        try {
            return new PhoneNumber($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(?string $value): ?PhoneNumber
    {
        if (is_null($value)) return null;
        return new PhoneNumber($value);
    }

    public function getWhatsAppFormat(): string
    {
        return sprintf(
            '%s%s%s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    public function getHumansFormat(): string
    {
        return $this->standardPhoneNumber->makeHumansFormat(
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    public function getE164Format(): string
    {
        return sprintf(
            '+%s%s%s',
            $this->countryCode,
            $this->areaCode,
            $this->localNumber
        );
    }

    public function getHiddenFormat(string $maskCharacter = '*'): string
    {
        return $this->standardPhoneNumber->makeHiddenFormat(
            $this->countryCode,
            $this->areaCode,
            $this->localNumber,
            $maskCharacter
        );
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
