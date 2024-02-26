<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\ValidatorFactory;
use Verdient\Hyperf3\Validation\ValidatorFactory as ValidationValidatorFactory;

class ConfigProvider
{
    public function __invoke(): array
    {
        return [
            'dependencies' => [
                ValidatorFactory::class => ValidationValidatorFactory::class
            ],
            'listeners' => [
                ValidatorFactoryResolvedListener::class
            ]
        ];
    }
}
