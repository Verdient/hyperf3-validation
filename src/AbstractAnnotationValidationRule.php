<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Closure;
use Hyperf\Di\ReflectionManager;
use Hyperf\Stringable\Str;
use Override;
use Verdient\Hyperf3\Validation\Annotation\Rule\RuleAnnotationInterface;

/**
 * 抽象注解验证规则
 *
 * @author Verdient。
 */
abstract class AbstractAnnotationValidationRule extends AbstractValidationRule implements RuleAnnotationInterface
{
    /**
     * 属性
     *
     * @author Verdient。
     */
    protected readonly string $attribute;

    /**
     * 验证器
     *
     * @author Verdient。
     */
    protected readonly Validator $validator;

    /**
     * @author Verdient。
     */
    #[Override]
    public function name(): string
    {
        $attributes = ReflectionManager::reflectClass(static::class)->getAttributes(ValidationRule::class);

        if (!empty($attributes)) {
            /** @var ValidationRule  */
            $validationRule = $attributes[0]->newInstance();

            if ($validationRule->name) {
                return $validationRule->name;
            }
        }

        return implode('.', array_map(fn($value) => Str::snake($value), explode('\\', static::class)));
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function validator(): Closure|string
    {
        $class = static::class;

        return (function ($attribute, $value, $parameters, $validator) use ($class) {
            $instance = (new $class(...array_map('unserialize', $parameters)));
            $instance->attribute = $attribute;
            $instance->validator = $validator;
            return $instance
                ->validate($value);
        })->bindTo(null);
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function toRule(): array
    {
        $values = [];

        foreach (ReflectionManager::reflectClass(static::class)->getProperties() as $property) {
            if ($property->isInitialized($this)) {
                $values[$property->name] = serialize($property->getValue($this));
            }
        }

        return [$this->name(), ...$values];
    }

    /**
     * 验证函数
     *
     * @param mixed $value 值
     *
     * @author Verdient。
     */
    abstract public function validate(mixed $value): bool;
}
