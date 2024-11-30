<?php

namespace Mkioschi\Types\Misc;

use Exception;
use Mkioschi\Types\InvalidTypeException;
use Mkioschi\Types\Str;

final class Path extends Str
{
    /**
     * @throws InvalidTypeException
     */
    protected function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException(sprintf('%s is an invalid Path type.', $value));
        }

        parent::__construct($value);
    }

    public static function isValid(mixed $value): bool
    {
        if (!is_string($value)) {
            return false;
        }

        return !preg_match("/[^0-9a-zA-ZÀ-ú \/).(+_-]/", $value);
    }

    /**
     * @throws Exception
     */
    public function join(...$paths): Path
    {
        if (count($paths) === 0) {
            throw new Exception('Join method needs at least one path.');
        }

        $newPath = $this->value;

        foreach($paths as $path) {
            if (!self::isValid($path)) {
                throw new Exception(sprintf('%s is a invalid path.', $path));
            }

            $newPath = $this->mergePath($newPath, $path);
        }

        return Path::from($newPath);
    }

    private function mergePath(string $firstPath, string $secondPath): string
    {
        return sprintf(
            '%s/%s',
            str_ends_with($firstPath, '/') ? substr($firstPath, 0, -1) : $firstPath,
            str_starts_with($secondPath, '/') ? substr($secondPath, 1) : $secondPath
        );
    }

    public function back(): Path
    {
        return Path::from(value: sprintf(
            '%s/../',
            str_ends_with($this->value, '/') ? substr($this->value, 0, -1) : $this->value
        ));
    }

    public function isAbsolutePath(): bool {
        return str_starts_with($this->value, '/');
    }

    public function isRelativePath(): bool {
        return !str_starts_with($this->value, '/');
    }

    public function getAsAbsolutePath(): string
    {
        if (str_starts_with($this->value, '/')) {
            return $this->value;
        }

        return sprintf('/%s', $this->value);
    }

    public function getAsRelativePath(): string
    {
        if (!str_starts_with($this->value, '/')) {
            return $this->value;
        }

        return substr($this->value, 1);
    }
}
