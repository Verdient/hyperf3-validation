<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\Request\FormRequest;

/**
 * 所有输入请求
 * @author Verdient。
 */
class InputRequest extends FormRequest
{
    use AsAuthorized;
}
