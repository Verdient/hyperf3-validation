<?php

declare(strict_types=1);

namespace Verdient\Hyperf3\Validation;

use Closure;
use Hyperf\Di\ReflectionManager;
use Hyperf\Stringable\Str;
use Override;

use function Hyperf\Support\class_basename;

/**
 * 抽象验证规则
 *
 * @author Verdient。
 */
abstract class AbstractValidationRule implements ValidationRuleInterface
{
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

        return Str::snake(class_basename(static::class));
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function type(): ValidationRuleType
    {
        $attributes = ReflectionManager::reflectClass(static::class)->getAttributes(ValidationRule::class);

        if (!empty($attributes)) {
            /** @var ValidationRule  */
            $validationRule = $attributes[0]->newInstance();

            return $validationRule->type;
        }

        return ValidationRuleType::DEFAULT;
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function message(): ?string
    {
        return null;
    }

    /**
     * @author Verdient。
     */
    #[Override]
    public function replacer(): Closure|string|null
    {
        return null;
    }
}
