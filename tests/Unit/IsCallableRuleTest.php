<?php

namespace Aegisora\Rules\Tests\Unit;

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

    private static function assertActualResultEqualsExpected(
        Result $result,
        array $expectedResult
    ): void {
        self::assertEquals($expectedResult['isValid'], $result->isValid());
        self::assertEquals($expectedResult['failedRuleCode'], $result->getFailedRuleCode());
    }
}
