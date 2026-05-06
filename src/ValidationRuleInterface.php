<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Closure;

/**
 * 验证规则接口
 *
 * @author Verdient。
 */
interface ValidationRuleInterface
{
    /**
     * 校验规则名称
     *
     * @author Verdient。
     */
    public static function name(): string;

    /**
     * 校验规则类型
     *
     * @author Verdient。
     */
    public static function type(): ValidationRuleType;

    /**
     * 校验方法
     *
     * @author Verdient。
     */
    public static function validator(): Closure|string;

    /**
     * 提示信息
     *
     * @author Verdient。
     */
    public static function message(): ?string;

    /**
     * 替换器
     *
     * @author Verdient。
     */
    public static function replacer(): Closure|string|null;
}