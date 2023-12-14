<?php declare(strict_types=1);

namespace Mkioschi\Types\Web;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class Ip extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Ip type.', $value));
        }

        parent::__construct(strtolower($value));
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_IP, [FILTER_FLAG_IPV4, FILTER_FLAG_IPV6]) !== false;
    }

    public function isV4(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4) !== false;
    }

    public function isV6(): bool
    {
        return filter_var($this->value, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6) !== false;
    }
}
