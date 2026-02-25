<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;
use Override;

/**
 * 消息体请求
 *
 * @author Verdient。
 */
class BodyRequest extends FormRequest
{
    use AsAuthorized;

    /**
     * @author Verdient。
     */
    #[Override]
    protected function validationData(): array
    {
        return $this->getParsedBody();
    }
}
