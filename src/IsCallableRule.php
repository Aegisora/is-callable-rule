<?php

namespace Aegisora\Rules;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;

class IsCallableRule extends Rule
{
    public static function create(): self
    {
        return new self();
    }

    protected function executeValidate(Context $context): Result
    {
        return is_callable($context->getValue()) ?
            $this->getDefaultValidResult() :
            $this->getDefaultInvalidResult();
    }
}
