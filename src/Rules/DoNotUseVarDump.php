<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<Node\Expr\FuncCall>
 */
class DoNotUseVarDump implements Rule
{
    public function getNodeType(): string
    {
        return Node\Expr\FuncCall::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        $name = $node->name;

        if (!$name instanceof Node\Name) {
            return [];
        }
        if ($name->toLowerString() !== 'var_dump') {
            return [];
        }

        return [
            RuleErrorBuilder::message('Do not use var_dump')->build()
        ];
    }
}
