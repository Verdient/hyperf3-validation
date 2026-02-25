<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Exception;
use Hyperf\Di\Annotation\AnnotationCollector;
use Hyperf\Event\Contract\ListenerInterface;
use Hyperf\Validation\Event\ValidatorFactoryResolved;
use Override;

use function Hyperf\Config\config;
use function Hyperf\Support\make;

/**
 * 验证器工厂解决事件监听器
 *
 * @author Verdient。
 */
class ValidatorFactoryResolvedListener implements ListenerInterface
{
    /**
     * @author Verdient。
     */
    #[Override]
    public function listen(): array
    {
        return [
            ValidatorFactoryResolved::class
        ];
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function process(object $event): void
    {
        /** @var ValidatorFactory */
        $validatorFactory = $event->validatorFactory;

        $validatorFactory->replacer('decimal', function ($message, $attribute, $rule, $parameters) {
            return str_replace(':decimal', implode(' - ', $parameters), $message);
        });

        $validatorFactory->resolver(function (...$args) {
            $validator = new Validator(...$args);
            $validator->addNumericRule('decimal');
            return $validator;
        });

        foreach ([
            ...array_keys(AnnotationCollector::getClassesByAnnotation(ValidationRule::class)),
            ...config('validation.rules', [])
        ] as $class) {
            $rule = make($class);

            if (!$rule instanceof ValidationRuleInterface) {
                continue;
            }

            switch ($rule->type()) {
                case ValidationRuleType::DEFAULT:
                    $validatorFactory->extend($rule->name(), $rule->validator(), $rule->message());
                    break;
                case ValidationRuleType::IMPLICIT:
                    $validatorFactory->extendImplicit($rule->name(), $rule->validator(), $rule->message());
                    break;
                case ValidationRuleType::DEPENDENT:
                    $validatorFactory->extendDependent($rule->name(), $rule->validator(), $rule->message());
                    break;
                case ValidationRuleType::NUMERIC:
                    $validatorFactory->extendNumeric($rule->name(), $rule->validator(), $rule->message());
                    break;
                default:
                    throw new Exception('Unsupported validation rule type: ' . $rule->type());
                    break;
            }

            if ($replacer = $rule->replacer()) {
                $validatorFactory->replacer($rule->name(), $replacer);
            }
        }
    }
}
