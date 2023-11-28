<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Tests\DoNotUserVarDump;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Taboritis\PhpstanCustomRules\Rules\DoNotUseVarDump;

/**
 * @extends RuleTestCase<DoNotUseVarDump>
 * @covers \Taboritis\PhpstanCustomRules\Rules\DoNotUseVarDump
 */
class DoNotUserVarDumpTest extends RuleTestCase
{
    /** @test */
    public function it_stops_on_var_dump(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/with_var_dump.php'], [
            [
                'Do not use var_dump',
                7,
            ],
        ]);
    }

    /** @test */
    public function it_passed_without_var_dump(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/without_var_dump.php'], []);
    }

    protected function getRule(): Rule
    {
        return new DoNotUseVarDump();
    }
}
