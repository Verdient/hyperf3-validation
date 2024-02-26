<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Server\Exception\ServerException;
use Throwable;

/**
 * 校验异常
 * @author Verdient。
 */
class ValidationException extends ServerException
{
    /**
     * @inheritdoc
     * @author Verdient。
     */
    public function __construct(
        string $message,
        int $code = 422,
        Throwable|null $previous = null
    ) {
        parent::__construct($message, $code, $previous);
    }
}
