<?php declare(strict_types=1);

namespace Mkioschi\Types\Misc;

readonly class PersonName
{
    public string $name;
    public string $surname;

    protected function __construct(string $name, string $surname)
    {
        $this->name = $name;
        $this->surname = $surname;
    }

    public static function from(string $name, string $surname): PersonName
    {
        return new PersonName($name, $surname);
    }

    public static function innFrom(?string $name, ?string $surname): ?PersonName
    {
        if (is_null($name) || is_null($surname)) {
            return null;
        }

        return new PersonName($name, $surname);
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->name,
            'last_name' => $this->surname,
        ];
    }

    public function getFullName(): string
    {
        return sprintf('%s %s', $this->name, $this->surname);
    }
}