<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\ControllerMetadata;

<<<<<<< HEAD
=======
use Symfony\Component\HttpKernel\Attribute\ArgumentInterface;

>>>>>>> origin/New-FakeMain
/**
 * Responsible for storing metadata of an argument.
 *
 * @author Iltar van der Berg <kjarli@gmail.com>
 */
class ArgumentMetadata
{
    public const IS_INSTANCEOF = 2;

<<<<<<< HEAD
    private string $name;
    private ?string $type;
    private bool $isVariadic;
    private bool $hasDefaultValue;
    private mixed $defaultValue;
    private bool $isNullable;
    private array $attributes;
=======
    private $name;
    private $type;
    private $isVariadic;
    private $hasDefaultValue;
    private $defaultValue;
    private $isNullable;
    private $attributes;
>>>>>>> origin/New-FakeMain

    /**
     * @param object[] $attributes
     */
<<<<<<< HEAD
    public function __construct(string $name, ?string $type, bool $isVariadic, bool $hasDefaultValue, mixed $defaultValue, bool $isNullable = false, array $attributes = [])
=======
    public function __construct(string $name, ?string $type, bool $isVariadic, bool $hasDefaultValue, $defaultValue, bool $isNullable = false, $attributes = [])
>>>>>>> origin/New-FakeMain
    {
        $this->name = $name;
        $this->type = $type;
        $this->isVariadic = $isVariadic;
        $this->hasDefaultValue = $hasDefaultValue;
        $this->defaultValue = $defaultValue;
        $this->isNullable = $isNullable || null === $type || ($hasDefaultValue && null === $defaultValue);
<<<<<<< HEAD
=======

        if (null === $attributes || $attributes instanceof ArgumentInterface) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'The "%s" constructor expects an array of PHP attributes as last argument, %s given.', __CLASS__, get_debug_type($attributes));
            $attributes = $attributes ? [$attributes] : [];
        }

>>>>>>> origin/New-FakeMain
        $this->attributes = $attributes;
    }

    /**
     * Returns the name as given in PHP, $foo would yield "foo".
<<<<<<< HEAD
     */
    public function getName(): string
=======
     *
     * @return string
     */
    public function getName()
>>>>>>> origin/New-FakeMain
    {
        return $this->name;
    }

    /**
     * Returns the type of the argument.
     *
     * The type is the PHP class in 5.5+ and additionally the basic type in PHP 7.0+.
<<<<<<< HEAD
     */
    public function getType(): ?string
=======
     *
     * @return string|null
     */
    public function getType()
>>>>>>> origin/New-FakeMain
    {
        return $this->type;
    }

    /**
     * Returns whether the argument is defined as "...$variadic".
<<<<<<< HEAD
     */
    public function isVariadic(): bool
=======
     *
     * @return bool
     */
    public function isVariadic()
>>>>>>> origin/New-FakeMain
    {
        return $this->isVariadic;
    }

    /**
     * Returns whether the argument has a default value.
     *
     * Implies whether an argument is optional.
<<<<<<< HEAD
     */
    public function hasDefaultValue(): bool
=======
     *
     * @return bool
     */
    public function hasDefaultValue()
>>>>>>> origin/New-FakeMain
    {
        return $this->hasDefaultValue;
    }

    /**
     * Returns whether the argument accepts null values.
<<<<<<< HEAD
     */
    public function isNullable(): bool
=======
     *
     * @return bool
     */
    public function isNullable()
>>>>>>> origin/New-FakeMain
    {
        return $this->isNullable;
    }

    /**
     * Returns the default value of the argument.
     *
     * @throws \LogicException if no default value is present; {@see self::hasDefaultValue()}
<<<<<<< HEAD
     */
    public function getDefaultValue(): mixed
=======
     *
     * @return mixed
     */
    public function getDefaultValue()
>>>>>>> origin/New-FakeMain
    {
        if (!$this->hasDefaultValue) {
            throw new \LogicException(sprintf('Argument $%s does not have a default value. Use "%s::hasDefaultValue()" to avoid this exception.', $this->name, __CLASS__));
        }

        return $this->defaultValue;
    }

    /**
<<<<<<< HEAD
=======
     * Returns the attribute (if any) that was set on the argument.
     */
    public function getAttribute(): ?ArgumentInterface
    {
        trigger_deprecation('symfony/http-kernel', '5.3', 'Method "%s()" is deprecated, use "getAttributes()" instead.', __METHOD__);

        if (!$this->attributes) {
            return null;
        }

        return $this->attributes[0] instanceof ArgumentInterface ? $this->attributes[0] : null;
    }

    /**
>>>>>>> origin/New-FakeMain
     * @return object[]
     */
    public function getAttributes(string $name = null, int $flags = 0): array
    {
        if (!$name) {
            return $this->attributes;
        }

        $attributes = [];
        if ($flags & self::IS_INSTANCEOF) {
            foreach ($this->attributes as $attribute) {
                if ($attribute instanceof $name) {
                    $attributes[] = $attribute;
                }
            }
        } else {
            foreach ($this->attributes as $attribute) {
                if (\get_class($attribute) === $name) {
                    $attributes[] = $attribute;
                }
            }
        }

        return $attributes;
    }
}
