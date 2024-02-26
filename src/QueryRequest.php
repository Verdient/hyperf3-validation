<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;

/**
 * 查询请求
 * @author Verdient。
 */
class QueryRequest extends FormRequest
{
    use AsAuthorized;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function validationData(): array
    {
        return $this->getQueryParams();
    }
}
