<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Attribute;
use Hyperf\Di\Annotation\AbstractAnnotation;

/**
 * 验证规则
 *
 * @author Verdient。
 */
#[Attribute(Attribute::TARGET_CLASS)]
class ValidationRule extends AbstractAnnotation
{
    /**
     * @param ValidationRuleType $type 类型
     * @param ?string $name 名称
     *
     * @author Verdient。
     */
    public function __construct(
        public readonly ValidationRuleType $type = ValidationRuleType::DEFAULT,
        public readonly ?string $name = null
    ) {}
}
