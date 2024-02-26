<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Closure;

/**
 * 验证规则接口
 * @author Verdient。
 */
interface ValidationRuleInterface
{
    /**
     * 校验规则名称
     * @return string
     * @author Verdient。
     */
    public function name(): string;

    /**
     * 校验规则类型
     * @return ValidationRuleType
     * @author Verdient。
     */
    public function type(): ValidationRuleType;

    /**
     * 校验方法
     * @return Closure|string
     * @author Verdient。
     */
    public function validator(): Closure|string;

    /**
     * 提示信息
     * @return ?string
     * @author Verdient。
     */
    public function message(): ?string;

    /**
     * 替换器
     * @return Closure|string|null
     * @author Verdient。
     */
    public function replacer(): Closure|string|null;
}
