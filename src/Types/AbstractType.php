<?php

namespace Mkioschi\Types;

abstract readonly class AbstractType implements TypeInterface
{
    public function clone(): static
    {
        return clone $this;
    }
}
