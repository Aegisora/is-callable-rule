<?php

namespace Aegisora\Rules\Tests\Unit;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\RuleInterface;
use Aegisora\Rules\IsCallableRule;
use PHPUnit\Framework\TestCase;
use stdClass;

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
            'context value - closure' => [
                'context' => Context::create(
                    static fn (): string => 'ok'
                ),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - anonymous class with invoke' => [
                'context' => Context::create(
                    new class {
                        public function __invoke(): string
                        {
                            return 'ok';
                        }
                    }
                ),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - global standard function name' => [
                'context' => Context::create('trim'),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - static method array callable' => [
                'context' => Context::create(
                    [self::class, 'staticCallableMethod']
                ),
                'expectedResult' => [
                    'isValid' => true,
                    'failedRuleCode' => null,
                ],
            ],
            'context value - object method callable' => [
                'context' => Context::create(
                    [new self(), 'instanceCallableMethod']
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
            'context value - positive float' => [
                'context' => Context::create(0.01),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - negative float' => [
                'context' => Context::create(-0.01),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - empty string' => [
                'context' => Context::create(''),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - not empty string' => [
                'context' => Context::create('fooo'),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - empty array' => [
                'context' => Context::create([]),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - not empty array' => [
                'context' => Context::create([1,]),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - object' => [
                'context' => Context::create(new stdClass()),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - resource' => [
                'context' => Context::create(tmpfile()),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
            'context value - invalid array callable' => [
                'context' => Context::create(
                    ['UnknownClass', 'method']
                ),
                'expectedResult' => [
                    'isValid' => false,
                    'failedRuleCode' => 'is_callable_rule',
                ],
            ],
        ];
    }

    public static function staticCallableMethod(): string
    {
        return 'ok';
    }

    public function instanceCallableMethod(): string
    {
        return 'ok';
    }

    private static function assertActualResultEqualsExpected(
        Result $result,
        array $expectedResult
    ): void {
        self::assertEquals($expectedResult['isValid'], $result->isValid());
        self::assertEquals($expectedResult['failedRuleCode'], $result->getFailedRuleCode());
    }
}
