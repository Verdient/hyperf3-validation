<?php

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;
use Override;

/**
 * 文件请求
 *
 * @author Verdient。
 */
class FileRequest extends FormRequest
{
    use AsAuthorized;

    /**
     * @author Verdient。
     */
    #[Override]
    protected function validationData(): array
    {
        return $this->getUploadedFiles();
    }
}
