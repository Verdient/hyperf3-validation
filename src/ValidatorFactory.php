<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Closure;
use Hyperf\Stringable\StrCache;
use Hyperf\Validation\Validator as ValidationValidator;
use Hyperf\Validation\ValidatorFactory as ValidationValidatorFactory;
use Verdient\Hyperf3\Validation\Validator;

/**
 * 验证器工厂
 * @author Verdient。
 */
class ValidatorFactory extends ValidationValidatorFactory
{
    /**
     * 数字扩展
     * @author Verdient。
     */
    protected array $numericExtensions = [];

    /**
     * 注册数字扩展
     * @param string $rule 规则名称
     * @param Closure|string $extension 扩展实现
     * @param ?string $message 提示消息
     * @author Verdient。
     */
    public function extendNumeric(string $rule, Closure|string $extension, ?string $message = null)
    {
        $this->numericExtensions[$rule] = $extension;

        if ($message) {
            $this->fallbackMessages[StrCache::snake($rule)] = $message;
        }
    }

    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function addExtensions(ValidationValidator $validator): void
    {
        parent::addExtensions($validator);

        if ($validator instanceof Validator) {
            $validator->addNumericExtensions($this->numericExtensions);
        }
    }
}
