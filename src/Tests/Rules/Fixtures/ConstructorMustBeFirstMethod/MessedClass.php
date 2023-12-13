<?php

declare(strict_types=1);

namespace Rules\Fixtures\ConstructorMustBeFirstMethod;

class MessedClass
{
    public function getFoo(): int
    {
        return $this->foo;
    }

    public function __construct(private int $foo)
    {
    }
}
