<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Tests\Rules;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Taboritis\PhpstanCustomRules\Rules\DoNotLeaveForgottenDumps;

/**
 * @covers \Taboritis\PhpstanCustomRules\Rules\DoNotLeaveForgottenDumps
 * @extends RuleTestCase<DoNotLeaveForgottenDumps>
 */
class DoNotLeaveForgottenDumpsTest extends RuleTestCase
{
    /** @test */
    public function it_fails_on_var_dumper_functions(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/DoNotLeaveForgottenDumps/with_dd.php'], [
            ['Do not use dump function', 7],
            ['Do not use dd function', 11],
        ]);
    }

    /** @test */
    public function it_fails_on_var_dump_function(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/DoNotLeaveForgottenDumps/with_var_dump.php'], [
            ['Do not use var_dump function', 7],
        ]);
    }

    /** @test */
    public function it_does_not_throws_errors_as_dumps_are_not_present(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/DoNotLeaveForgottenDumps/no_dumps_script.php'], []);
    }

    protected function getRule(): Rule
    {
        return new DoNotLeaveForgottenDumps();
    }
}
