<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Rules;

use PhpParser\Node;
use PhpParser\Node\Expr\FuncCall;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<FuncCall>
 */
class DoNotLeaveForgottenDumps implements Rule
{
    public function getNodeType(): string
    {
        return FuncCall::class;
    }


    public function processNode(Node $node, Scope $scope): array
    {
        $name = $node->name;

        if (!$name instanceof Node\Name) {
            return [];
        }

        $functionName = $name->toLowerString();

        return [
            RuleErrorBuilder::message("Do not use {$functionName} function")->build()
        ];
    }
}
