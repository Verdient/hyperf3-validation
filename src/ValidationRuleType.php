<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

/**
 * 验证规则类型
 * @author Verdient。
 */
enum ValidationRuleType: string
{
    case DEFAULT = 'DEFAULT';
    case IMPLICIT = 'IMPLICIT';
    case DEPENDENT = 'DEPENDENT';
    case NUMERIC = 'NUMERIC';
}
