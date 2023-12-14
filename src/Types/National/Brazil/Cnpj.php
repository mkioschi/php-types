<?php declare(strict_types=1);

namespace Mkioschi\Types\National\Brazil;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Mkioschi\Types\Str;

final class Cnpj extends Str
{
    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException(sprintf('%s is an invalid Cnpj type.', $value));
        }

        parent::__construct(Str::extractNumbers($value));
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        $cnpj = Str::extractNumbers($value);

        if (strlen($cnpj) !== 14) {
            return false;
        }

        if (preg_match(pattern: '/(\d)\1{13}/', subject: $cnpj)) {
            return false;
        }

        for ($i = 0, $j = 5, $sum = 0; $i < 12; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        if ($cnpj[12] != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        for ($i = 0, $j = 6, $sum = 0; $i < 13; $i++) {
            $sum += $cnpj[$i] * $j;
            $j = ($j == 2) ? 9 : $j - 1;
        }

        $rest = $sum % 11;

        if ($cnpj[13] != ($rest < 2 ? 0 : 11 - $rest)) {
            return false;
        }

        return true;
    }

    public function getHumansFormat(): string
    {
        return sprintf(
            '%s.%s.%s/%s-%s',
            substr($this->value, 0, 2),
            substr($this->value, 2, 3),
            substr($this->value, 5, 3),
            substr($this->value, 8, 4),
            substr($this->value, -2)
        );
    }
}
