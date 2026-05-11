<?php

namespace Aegisora\Rules\Tests\Unit;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\RuleInterface;
use Aegisora\Rules\IsCallableRule;
use PHPUnit\Framework\TestCase;

class IsCallableRuleTest extends TestCase
{
    private IsCallableRule $rule;

    protected function setUp(): void
    {
        parent::setUp();

        $this->rule = new IsCallableRule();
    }

    public function testCreate(): void
    {
        self::assertInstanceOf(RuleInterface::class, IsCallableRule::create());
    }

    /**
     * @dataProvider getTestValidateProvidedData
     */
    public function testValidate(
        Context $context,
        array $expectedResult
    ): void {
        self::assertActualResultEqualsExpected(
            $this->rule->validate($context),
            $expectedResult
        );
    }

    public static function getTestValidateProvidedData(): array
    {
        return [
            'context value - callable' => [
                'context' => Context::create(
                    static function (): void {
                    }
                ),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - zero integer' => [
                'context' => Context::create(0),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - positive integer' => [
                'context' => Context::create(1),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - negative integer' => [
                'context' => Context::create(-1),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - zero float' => [
                'context' => Context::create(0.0),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
        ];
    }

    private static function assertActualResultEqualsExpected(
        Result $result,
        array $expectedResult
    ): void {
        self::assertEquals($expectedResult['isValid'], $result->isValid());
        self::assertEquals($expectedResult['failedRuleCode'], $result->getFailedRuleCode());
    }
}
