<?php

namespace Mkioschi\Types\National\Brazil;

use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\Str;

final class VehiclePlate extends Str
{
    private const string PLATE_REGEX = '/[A-Z]{3}[0-9][0-9A-Z][0-9]{2}/';

    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid Vehicle Plate type.', $value));
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
