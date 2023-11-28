<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\DontUserDieAndDump;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/** @implements Rule<FuncCall> */
class DontUseDieAndDumpRule implements Rule
{
    public function getNodeType(): string
    {
        return FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        /** @var Node\Name $name */
        $name = $node->name;

        if (!$name instanceof Node\Name) {
            return [];
        }

        if ($name->toLowerString() !== 'dd') {
            return [];
        }

        return [
            RuleErrorBuilder::message('Die and dump is not allowed')->build()
        ];
    }
}
