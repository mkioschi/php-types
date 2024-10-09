<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

use Mkioschi\Enums\UnitTime;
use Mkioschi\Types\AbstractType;
use Mkioschi\Types\InvalidTypeException;
use Throwable;

final class Time extends AbstractType
{
    public readonly string $value;

    /**
     * @throws InvalidTypeException
     */
    private function __construct(string $value)
    {
        if (!self::isValid($value)) {
            throw new InvalidTypeException();
        }

        $this->value = $value;
    }

    public static function isValid(string $value): bool
    {
        return !is_null(self::parseTime($value));
    }

    /**
     * @return ?array{0: float|int, 1: UnitTime}
     */
    public static function parseTime(string $time): ?array
    {
        try {
            preg_match('/([\d.]+)([a-zA-Z]+)/', $time, $matches);

            if (count($matches) !== 3) {
                return null;
            }

            if (!is_numeric($matches[1])) {
                return null;
            }

            return [
                str_contains($matches[1], '.') ? (float)$matches[1] : (int)$matches[1],
                UnitTime::from($matches[2])
            ];
        } catch (Throwable) {
            return null;
        }
    }

    /**
     * @throws InvalidTypeException
     */
    public static function from(string $value): Time
    {
        return new Time($value);
    }

    /**
     * @throws InvalidTypeException
     */
    public static function innFrom(?string $value): ?Time
    {
        if (is_null($value)) {
            return null;
        }

        return new Time($value);
    }

    public function sleep(): void
    {
        [$amount, $unit] = self::parseTime($this->value);

        match ($unit) {
            UnitTime::MICROSECOND => usleep((int)$amount),
            UnitTime::MILISECOND => usleep((int)$this->milisecondsToMicroseconds($amount)),
            UnitTime::SECOND => $this->sleepSeconds($amount),
            UnitTime::MINUTE => sleep((int)$this->minutesToSeconds($amount)),
            UnitTime::HOUR => sleep((int)$this->hoursToSeconds($amount)),
        };
    }

    private function sleepSeconds(float|int $seconds): void
    {
        if (is_int($seconds)) {
            sleep($seconds);
            return;
        }

        usleep((int)$this->secondsToMicroseconds($seconds));
    }

    private function secondsToMicroseconds(float|int $seconds): float|int
    {
        return $seconds * 1000000;
    }

    private function milisecondsToMicroseconds(float|int $milliseconds): float|int
    {
        return $milliseconds * 1000;
    }

    private function minutesToSeconds(float|int $minutes): float|int
    {
        return $minutes * 60;
    }

    private function hoursToSeconds(float|int $hour): float|int
    {
        return $hour * 3600;
    }

    public function __toString(): string
    {
        return $this->value;
    }
}
