<?php

namespace Mkioschi\Types\Web;

use Mkioschi\Enums\UriScheme;
use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\Str;

final class Url extends Str
{
    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid Url type.', $value));
        }

        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return filter_var($value, FILTER_VALIDATE_URL) !== false;
    }

    public function getScheme(): string
    {
        return parse_url($this->value, PHP_URL_SCHEME);
    }

    public function getUser(): ?string
    {
        return parse_url($this->value, PHP_URL_USER);
    }

    public function getPassword(): ?string
    {
        return parse_url($this->value, PHP_URL_PASS);
    }

    public function getHost(): string
    {
        return parse_url($this->value, PHP_URL_HOST);
    }

    public function getPort(): int
    {
        return parse_url($this->value, PHP_URL_PORT) ?? 80;
    }

    public function getPath(): ?string
    {
        return parse_url($this->value, PHP_URL_PATH);
    }

    public function getQuery(): ?string
    {
        return parse_url($this->value, PHP_URL_QUERY);
    }

    public function getQueryAsArray(): ?array
    {
        $query = parse_url($this->value, PHP_URL_QUERY);

        if (is_null($query)) {
            return null;
        }

        parse_str($query, $result);

        return $result;
    }

    public function getFragment(): ?string
    {
        return parse_url($this->value, PHP_URL_FRAGMENT);
    }

    public function isSecure(): bool
    {
        return strtolower(parse_url($this->value, PHP_URL_SCHEME)) === UriScheme::HTTPS->value;
    }
}
