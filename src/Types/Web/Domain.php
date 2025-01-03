<?php

namespace Mkioschi\Types\Web;

use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\Str;

final class Domain extends Str
{
    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid Domain type.', $value));
        }

        parent::__construct(strtolower($value));
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (!str_contains($value, '.')) {
            return false;
        }

        $valueLength = strlen($value);

        if ($valueLength < 1 || $valueLength > 253) {
            return false;
        }

        if (!preg_match("/^[^.]{1,63}(.[^.]{1,63})*$/", $value)) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_DOMAIN, FILTER_FLAG_HOSTNAME) !== false;
    }
}
