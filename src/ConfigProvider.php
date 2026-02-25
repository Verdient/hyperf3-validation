<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Hyperf\Validation\ValidatorFactory;
use Verdient\Hyperf3\Validation\Rule\DistinctInGroupRule;
use Verdient\Hyperf3\Validation\Rule\NotUrlRule;
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
            ],
            'validation' => [
                'rules' => [
                    DistinctInGroupRule::class,
                    NotUrlRule::class
                ]
            ],
            'publish' => [
                [
                    'id' => 'config',
                    'description' => 'The config for validation.',
                    'source' => dirname(__DIR__) . '/publish/validation.php',
                    'destination' => constant('BASE_PATH') . '/config/autoload/validation.php',
                ]
            ]
        ];
    }
}
