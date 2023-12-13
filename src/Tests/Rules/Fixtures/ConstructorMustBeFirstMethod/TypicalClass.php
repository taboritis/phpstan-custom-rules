<?php

declare(strict_types=1);

namespace Rules\Fixtures\ConstructorMustBeFirstMethod;

class TypicalClass
{
    public function __construct(private int $parameter)
    {
    }

    public function getParameter(): int
    {
        return $this->parameter;
    }
}
