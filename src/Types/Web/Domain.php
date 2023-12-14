<?php declare(strict_types=1);

namespace Mkioschi\Types\Web;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class Domain extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Domain type.', $value));
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
