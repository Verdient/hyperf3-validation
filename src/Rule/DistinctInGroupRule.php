<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation\Rule;

use Closure;
use Override;
use Verdient\Hyperf3\Validation\AbstractValidationRule;
use Verdient\Hyperf3\Validation\ValidationRuleType;

/**
 * 组内唯一
 *
 * @author Verdient。
 */
class DistinctInGroupRule extends AbstractValidationRule
{
    /**
     * @author Verdient。
     */
    #[Override]
    public static function name(): string
    {
        return 'distinct_in_group';
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
            $keys = explode('.', $attribute);

            array_pop($keys);

            $values = $validator->getData();

            foreach ($keys as $key) {
                if (!isset($values[$key])) {
                    return true;
                }

                $values = $values[$key];
            }


            if (count(array_unique($values, SORT_REGULAR)) !== count($values)) {
                return false;
            }

            return true;
        })->bindTo(null);
    }
}