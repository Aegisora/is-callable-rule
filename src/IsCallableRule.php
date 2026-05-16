<?php

namespace Aegisora\Rules;

use Aegisora\RuleContract\Models\Context;
use Aegisora\RuleContract\Models\Result;
use Aegisora\RuleContract\Rule;
use Closure;

class IsCallableRule extends Rule
{
    public static function create(): self
    {
        return new self();
    }

    protected function executeValidate(Context $context): Result
    {
        return $this->isCallable($context->getValue()) ?
            $this->getDefaultValidResult() :
            $this->getDefaultInvalidResult();
    }

    /**
     * @param mixed $value
     */
    private function isCallable($value): bool
    {
        if ($value instanceof Closure) {
            return true;
        }

        return is_callable($value);
    }
}
