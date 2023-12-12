<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

class DoNotLeaveForgottenDumps implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $functionName = $node->name->toString();

        return [
            RuleErrorBuilder::message("Do not use {$functionName} function")->build()
        ];
    }
}
