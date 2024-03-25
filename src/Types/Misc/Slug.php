<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\Str;

final class Slug extends Str
{
    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid Slug type.', $value));
        }

        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        if (strlen($value) < 1) {
            return false;
        }

        return !preg_match("/[^0-9a-z-]/", $value);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function fromText(string $text): Slug
    {
        return new Slug(self::slugify($text));
    }
}
