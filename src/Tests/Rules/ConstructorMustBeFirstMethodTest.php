<?php

declare(strict_types=1);

namespace Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Taboritis\PhpstanCustomRules\Rules\ConstructorMustBeFirstMethod;

/**
 * @covers \Taboritis\PhpstanCustomRules\Rules\ConstructorMustBeFirstMethod
 * @extends RuleTestCase<ConstructorMustBeFirstMethod>
 */
class ConstructorMustBeFirstMethodTest extends RuleTestCase
{
    /** @test */
    public function it_passes_it_there_is_not_constructor(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/ConstructorMustBeFirstMethod/WithoutConstructor.php'], []);
    }
    /** @test */
    public function it_passes_as_constructor_is_first_method(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/ConstructorMustBeFirstMethod/TypicalClass.php'], []);
    }

    /** @test */
    public function it_fails_if_constructor_is_not_first_method(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/ConstructorMustBeFirstMethod/MessedClass.php'], [
            ['Constructor must be first method', 7],
        ]);
    }


    protected function getRule(): Rule
    {
        return new ConstructorMustBeFirstMethod();
    }
}
