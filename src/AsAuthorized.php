<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Override;

/**
 * 将请求视为已认证
 *
 * @author Verdient。
 */
trait AsAuthorized
{
    /**
     * @author Verdient。
     */
    #[Override]
    protected function authorize(): bool
    {
        return true;
    }
}
