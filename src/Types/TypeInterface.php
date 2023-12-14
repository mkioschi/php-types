<?php declare(strict_types=1);

namespace Mkioschi\Types;

interface TypeInterface
{
    public function clone(): static;
}
