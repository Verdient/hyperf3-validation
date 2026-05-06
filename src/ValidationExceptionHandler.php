<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Codec\Json;
use Hyperf\ExceptionHandler\ExceptionHandler;
use Hyperf\HttpMessage\Stream\SwooleStream;
use Hyperf\HttpServer\Exception\Http\EncodingException;
use Hyperf\Validation\ValidationException as ValidationValidationException;
use Override;
use Psr\Http\Message\ResponseInterface;
use Throwable;
use Verdient\Hyperf3\Validation\ValidationException;

/**
 * 校验异常处理器
 *
 * @author Verdient。
 */
class ValidationExceptionHandler extends ExceptionHandler
{
    /**
     * @author Verdient。
     */
    #[Override]
    public function handle(Throwable $throwable, ResponseInterface $response)
    {
        $this->stopPropagation();
        if ($throwable instanceof ValidationException) {
            $code = $throwable->getCode();
            $message = $throwable->getMessage();
            $errors = [$message];
        } else {
            /** @var ValidationValidationException $throwable */
            $code = $throwable->status;
            $messageBag = $throwable->validator->errors();
            $message = $messageBag->first();
            $errors = $messageBag->getMessages();
        }
        try {
            $result = Json::encode([
                'code' => $code,
                'data' => null,
                'message' => $message,
                'errors' => $errors
            ]);
        } catch (\Throwable $exception) {
            throw new EncodingException($exception->getMessage(), $exception->getCode());
        }
        return $response
            ->withStatus($code)
            ->withHeader('content-type', 'application/json; charset=utf-8')
            ->withBody(new SwooleStream($result));
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function isValid(Throwable $throwable): bool
    {
        return $throwable instanceof ValidationValidationException
            || $throwable instanceof ValidationException;
    }
}