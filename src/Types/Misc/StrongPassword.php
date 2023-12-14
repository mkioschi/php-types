<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Exception;

final class StrongPassword
{
    const MIN_LENGTH = 8;
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

    public static function validator(mixed $value): ?array
    {
        if (strlen($value) < self::MIN_LENGTH || strlen($value) > self::MAX_LENGTH) {
            $errors[] = sprintf(
                'The password must contain at least %s characters and a maximum of %s.',
                self::MIN_LENGTH,
                self::MAX_LENGTH
            );
        }

        if (preg_match('@[A-Z]@', $value) === 0) {
            $errors[] = 'The password must contain at least one uppercase letter.';
        }

        if (preg_match('@[a-z]@', $value) === 0) {
            $errors[] = 'The password must contain at least one lowercase letter.';
        }

        if (preg_match('@[0-9]@', $value) === 0) {
            $errors[] = 'The password must contain at least one number.';
        }

        if (preg_match('@\W@', $value) === 0) {
            $errors[] = 'The password must contain at least one special char.';
        }

        return $errors ?? null;
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function from(string $value): StrongPassword
    {
        return new StrongPassword($value);
    }

    public static function tryFrom(string $value): ?StrongPassword
    {
        try {
            return new StrongPassword($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(?string $value): ?StrongPassword
    {
        if (is_null($value)) {
            return null;
        }

        return new StrongPassword($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(StrongPassword $value): bool
    {
        return $this->value === $value->value;
    }
}
