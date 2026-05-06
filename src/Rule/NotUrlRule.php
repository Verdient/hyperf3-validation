<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation\Rule;

use Attribute;
use Closure;
use Hyperf\Stringable\Str;
use Override;
use Verdient\Hyperf3\Validation\AbstractValidationRule;
use Verdient\Hyperf3\Validation\ValidationRuleType;

/**
 * 不是网址
 *
 * @author Verdient。
 */
#[Attribute(Attribute::TARGET_CLASS | Attribute::TARGET_PROPERTY)]
class NotUrlRule extends AbstractValidationRule
{
    /**
     * @author Verdient。
     */
    #[Override]
    public static function name(): string
    {
        return 'not_url';
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public static function type(): ValidationRuleType
    {
        return ValidationRuleType::DEFAULT;
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public static function validator(): Closure|string
    {
        return (function ($attribute, $value, $parameters, $validator) {
            if (!is_string($value)) {
                return true;
            }

            return !Str::isUrl($value);
        })->bindTo(null);
    }
}