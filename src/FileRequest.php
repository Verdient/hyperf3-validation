<?php

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;

/**
 * 文件请求
 * @author Verdient。
 */
class FileRequest extends FormRequest
{
    use AsAuthorized;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function validationData(): array
    {
        return $this->getUploadedFiles();
    }
}
