<?php declare(strict_types=1);

namespace Mkioschi\Types\National\Brazil;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class VehiclePlate extends Str
{
    private const string PLATE_REGEX = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Vehicle Plate type.', $value));
        }

        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (preg_match(self::PLATE_REGEX, $value) !== 1) {
            return false;
        }

        return true;
    }
}
