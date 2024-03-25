<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Exception;

final readonly class IncrementalId
{
    public int $value;

    /**
     * @throws InvalidTypeException
     */
    protected function __construct(int $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException('Invalid IncrementalId value.');
        }

        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_int($value) && $value > 0;
    }

    /**
     * @throws InvalidTypeException
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
     * @throws InvalidTypeException
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
     * @throws InvalidTypeException
     */
    public function next(): IncrementalId
    {
        return new IncrementalId($this->value + 1);
    }

    /**
     * @throws InvalidTypeException
     */
    public function previous(): ?IncrementalId
    {
        if ($this->value === 1) {
            return null;
        }

        return new IncrementalId($this->value - 1);
    }
}
