<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Stringable\Str;
use Hyperf\Validation\Validator as ValidationValidator;
use Override;

/**
 * @inheritdoc
 *
 * @author Verdient。
 */
class Validator extends ValidationValidator
{
    /**
     * 批量添加数字扩展
     *
     * @param array $extensions 扩展
     *
     * @author Verdient。
     */
    public function addNumericExtensions($extensions)
    {
        $this->addExtensions($extensions);
        foreach (array_keys($extensions) as $rule) {
            $this->addNumericRule($rule);
        }
    }

    /**
     * 添加数字扩展
     *
     * @param string $rule 规则名称
     * @param Closure|string $extension 扩展
     *
     * @author Verdient。
     */
    public function addNumericExtension(string $rule, $extension)
    {
        $this->addExtension($rule, $extension);
        $this->addNumericRule($rule);
    }

    /**
     * 添加数字规则
     *
     * @param string $rule 规则名称
     *
     * @author Verdient。
     */
    public function addNumericRule($rule)
    {
        $rule = Str::studly($rule);
        if (!in_array($rule, $this->numericRules)) {
            $this->numericRules[] = $rule;
        }
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function validateString(string $attribute, $value): bool
    {
        return is_scalar($value) && !is_bool($value);
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function validateDecimal(string $attribute, mixed $value, array $parameters): bool
    {
        if (is_numeric($value)) {
            $value = strval($value);
        }
        return parent::validateDecimal($attribute, $value, $parameters);
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function makeReplacements(string $message, string $attribute, string $rule, array $parameters): string
    {
        return parent::makeReplacements($message, $attribute, $rule, array_map(function ($value) {
            if (is_int($value)) {
                return strval($value);
            }
            if (is_float($value)) {
                return strval($value);
            }
            return $value;
        }, $parameters));
    }
}
