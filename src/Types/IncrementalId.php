<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Exception;

final class IncrementalId
{
    public readonly int $value;

    /**
     * @throws InvalidTypeHttpException
     */
    protected function __construct(int $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeHttpException('Invalid IncrementalId value.');
        }

        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value) && $value > 0;
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function from(int $value): IncrementalId
    {
        return new IncrementalId($value);
    }

    public static function tryFrom(int $value): ?IncrementalId
    {
        try {
            return new IncrementalId($value);
        } catch (Exception) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFrom(int|null $value): ?IncrementalId
    {
        if (is_null($value)) {
            return null;
        }

        return new IncrementalId($value);
    }

    public function __toString(): string
    {
        return (string)$this->value;
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function next(): IncrementalId
    {
        return new IncrementalId($this->value + 1);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public function previous(): ?IncrementalId
    {
        if ($this->value === 1) {
            return null;
        }

        return new IncrementalId($this->value - 1);
    }
}
