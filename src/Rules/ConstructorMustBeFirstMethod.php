<?php

declare(strict_types=1);

namespace Taboritis\PhpstanCustomRules\Rules;

use PhpParser\Node;
use PHPStan\Analyser\Scope;
use PHPStan\Node\ClassMethodsNode;
use PHPStan\Rules\Rule;
use PHPStan\Rules\RuleErrorBuilder;

/**
 * @implements Rule<ClassMethodsNode>
 */
class ConstructorMustBeFirstMethod implements Rule
{
    public function getNodeType(): string
    {
        return ClassMethodsNode::class;
    }

    public function processNode(Node $node, Scope $scope): array
    {
        if ($this->hasMethods($node) === false) {
            return [];
        }

        if ($this->hasConstructor($node) === false) {
            return [];
        }

        if ($this->constructorIsFirstMethod($node) === true) {
            return [];
        }

        return [
            RuleErrorBuilder::message('Constructor must be first method')->build()
        ];
    }

    private function hasMethods(ClassMethodsNode $node): bool
    {
        return count($node->getMethods()) > 0;
    }

    private function hasConstructor(ClassMethodsNode $node): bool
    {
        $constructor = array_filter($node->getMethods(), function ($method) {
            return $method->name->name == '__construct';
        });

        return count($constructor) > 0;
    }

    private function constructorIsFirstMethod(ClassMethodsNode $node): bool
    {
        $constructorLine = 0;
        $otherLines = [];

        foreach ($node->getMethods() as $method) {
            $methodStartLine = $method->getAttributes()['startLine'];

            if ($method->name->name === '__construct') {
                $constructorLine = $methodStartLine;
            } else {
                $otherLines[] = $methodStartLine;
            }
        }

        return $constructorLine < min($otherLines);
    }
}
