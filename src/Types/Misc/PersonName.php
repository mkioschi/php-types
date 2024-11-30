<?php

namespace Mkioschi\Types\Misc;

class PersonName
{
    public readonly string $firstName;

    public readonly string $lastName;

    public string $fullName {
        get => "$this->firstName $this->lastName";
    }

    protected function __construct(string $firstName, string $lastName)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
    }

    public static function from(string $firstName, string $lastName): PersonName
    {
        return new PersonName($firstName, $lastName);
    }

    public static function innFrom(?string $firstName, ?string $lastName): ?PersonName
    {
        if (is_null($firstName) || is_null($lastName)) {
            return null;
        }

        return new PersonName($firstName, $lastName);
    }

    public function toArray(): array
    {
        return [
            'first_name' => $this->firstName,
            'last_name' => $this->lastName,
        ];
    }
}