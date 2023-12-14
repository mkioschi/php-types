<?php declare(strict_types=1);

namespace Mkioschi\Types\Web;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class Email extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Email type.', $value));
        }

        parent::__construct(strtolower($value));
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false;
    }

    public function getHiddenFormat(string $maskCharacter = '*'): string
    {
        $emailExploded = explode('@', $this->value);
        $mailPart = array_shift($emailExploded);
        $domainPart = array_shift($emailExploded);

        return sprintf(
            '%s@%s',
            $this->mask($mailPart, $maskCharacter),
            $this->mask($domainPart, $maskCharacter)
        );
    }

    private function mask(string $value, string $maskCharacter): string
    {
        if (strlen($value) === 2) return sprintf(
            '%s%s',
            substr($value, 0, 1),
            $maskCharacter,
        );

        if (strlen($value) <= 10) return sprintf(
            '%s%s%s',
            substr($value, 0, 1),
            str_repeat($maskCharacter, strlen($value) - 2),
            substr($value, -1)
        );

        return sprintf(
            '%s%s%s',
            substr($value, 0, 2),
            str_repeat($maskCharacter, strlen($value) - 3),
            substr($value, -1)
        );
    }
}
