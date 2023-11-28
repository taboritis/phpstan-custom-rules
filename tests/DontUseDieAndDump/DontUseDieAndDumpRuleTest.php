<?php

declare(strict_types=1);

namespace Tests\Taboritis\PhpstanCustomRules\DontUserDieAndDump;

use PHPStan\Rules\Rule;
use PHPStan\Testing\RuleTestCase;
use Taboritis\PhpstanCustomRules\DontUseDieAndDump\DontUseDieAndDumpRule;

/**
 * @extends RuleTestCase<DontUseDieAndDumpRule>
 * @covers \Taboritis\PhpstanCustomRules\DontUseDieAndDump\DontUseDieAndDumpRule
 */
class DontUseDieAndDumpRuleTest extends RuleTestCase
{
    /** @test */
    public function it_dont_throws_error_for_non_dd_script(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/non_dd_script.php'], []);
    }

    /** @test */
    public function it_throws_an_error_for_script_with_dd(): void
    {
        $this->analyse([__DIR__ . '/Fixtures/with_dd.php'], [
            [
                'Die and dump is not allowed',
                9,
            ],
        ]);
    }


    protected function getRule(): Rule
    {
        return new DontUseDieAndDumpRule();
    }
}
