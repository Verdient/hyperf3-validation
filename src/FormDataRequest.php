<?php

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;

/**
 * FormData 请求
 * @author Verdient。
 */
class FormDataRequest extends FormRequest
{
    use AsAuthorized;

    /**
     * @inheritdoc
     * @author Verdient。
     */
    protected function validationData(): array
    {
        $data = $this->getParsedBody();
        if (is_array($data)) {
            return array_merge_recursive($data, $this->getUploadedFiles());
        }
        return $this->getUploadedFiles();
    }
}
