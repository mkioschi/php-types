<?php declare(strict_types=1);

namespace Mkioschi\Types;

abstract class AbstractType implements TypeInterface
{
    public function clone(): static
    {
        return clone $this;
    }
}
