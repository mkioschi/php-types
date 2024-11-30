<?php

namespace Mkioschi\Types;

use Cocur\Slugify\Slugify;
use Exception;

class Str
{
    public readonly string $value;

    protected function __construct(string $value)
    {
        $this->value = $value;
    }

    public static function isValid(mixed $value): bool
    {
        return is_string($value);
    }

    public static function from(string $value): static
    {
        return new static($value);
    }

    public static function tryFrom(string $value): ?static
    {
        try {
            return new static($value);
        } catch (Exception) {
            return null;
        }
    }

    public static function innFrom(?string $value): ?static
    {
        if (is_null($value)) return null;
        return new static($value);
    }

    public function __toString(): string
    {
        return $this->value;
    }

    public function equals(self $value): bool
    {
        return $this->value === $value->value;
    }

    public static function extractNumbers(string $value): string
    {
        return preg_replace(pattern: '/\D/i', replacement: '', subject: trim($value));
    }

    public static function slugify(string $text): string
    {
        $slugify = new Slugify();
        return $slugify->slugify($text);
    }

    public function getSlugFormat(): string
    {
        return self::slugify($this->value);
    }

    public function length(): int
    {
        return strlen($this->value);
    }
}
