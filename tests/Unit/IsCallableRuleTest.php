<?php

namespace Aegisora\Rules\Tests\Unit;

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
}
