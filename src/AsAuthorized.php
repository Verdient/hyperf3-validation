<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

/**
 * 将请求视为已认证
 * @author Verdient。
 */
trait AsAuthorized
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function authorize(): bool
    {
        return true;
    }
}
