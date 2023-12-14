<?php declare(strict_types=1);

namespace Mkioschi\Types;

use Countable;
use Exception;
use Mkioschi\Exceptions\Http\InvalidTypeHttpException;
use Iterator;

class Arr implements Countable, Iterator
{
    public readonly array $value;
    protected int $index;

    protected function __construct(array $value)
    {
        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_array($value);
    }

    public static function from(array $value): static
    {
        return new static($value);
    }

    public static function tryFrom(array $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    public static function innFrom(?array $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function fromJson(string $value): static
    {
        $parsedValue = json_decode($value, true);

        if (!is_array($parsedValue) || json_last_error() !== JSON_ERROR_NONE) {
            throw new InvalidTypeHttpException(sprintf('\'%s\' is a invalid json string.', $value));
        }

        return new static($parsedValue);
    }

    /**
     * @throws InvalidTypeHttpException
     */
    public static function innFromJson(?string $value): ?static
    {
        if (is_null($value)) {
            return null;
        }

        return static::fromJson($value);
    }

    public function toJson(): string
    {
        return json_encode($this->value);
    }

    public function __toString(): string
    {
        return $this->toJson();
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    public static function isValidJsonString(string $value): bool
    {
        return is_array(json_decode($value, true)) && json_last_error() === JSON_ERROR_NONE;
    }

    public function count(): int
    {
        return count($this->value);
    }

    public function current(): mixed
    {
        return $this->value[$this->index];
    }

    public function next(): void
    {
        ++$this->index;
    }

    public function key(): int
    {
        return $this->index;
    }

    public function valid(): bool
    {
        return isset($this->value[$this->index]);
    }

    public function rewind(): void
    {
        $this->index = 0;
    }

    public static function trimNulls(array $array): array
    {
        foreach ($array as $value) {
            if (!is_null($value)) {
                $newArray[] = $value;
            }
        }

        return $newArray ?? [];
    }

    public static function toKeyValue(array $array, string $keyName = 'key', string $valueName = 'value'): array
    {
        foreach ($array as $key => $value) {
            $keyValueArr[] = [
                $keyName => $key,
                $valueName => $value,
            ];
        }

        return $keyValueArr ?? [];
    }

    public function isSequential(): bool
    {
        return self::isSequentialArray($this->value);
    }

    public function isAssociative(): bool
    {
        return self::isAssociativeArray($this->value);
    }

    public static function isSequentialArray(array $array): bool
    {
        return array_values($array) === $array;
    }

    public static function isAssociativeArray(array $array): bool
    {
        return array_values($array) !== $array;
    }
}
