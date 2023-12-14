<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Exception;

final class Password
{
    const MIN_LENGTH = 6;
    const MAX_LENGTH = 45;

    public readonly string $value;

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        $errors = self::validator($value);

        if ($errors) {
            throw new InvalidTypeHttpException(errors: $errors);
        }

        $this->value = $value;
    }

    public static function isValid(string $value): bool
    {
        return is_null(self::validator($value));
    }

    public static function validator(string $value): ?array
    {
        if (strlen($value) < self::MIN_LENGTH || strlen($value) > self::MAX_LENGTH) {
            $errors[] = sprintf(
                'The password must contain at least %s characters and a maximum of %s.',
                self::MIN_LENGTH,
                self::MAX_LENGTH
            );
        }

        return $errors ?? null;
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function from(string $value): Password
    {
        return new Password($value);
    }

    public static function tryFrom(string $value): ?Password
    {
        try {
            return new Password($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(?string $value): ?Password
    {
        if (is_null($value)) {
            return null;
        }

        return new Password($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(Password $value): bool
    {
        return $this->value === $value->value;
    }
}
