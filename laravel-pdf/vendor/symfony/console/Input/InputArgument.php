<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Input;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Represents a command line argument.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class InputArgument
{
    public const REQUIRED = 1;
    public const OPTIONAL = 2;
    public const IS_ARRAY = 4;

<<<<<<< HEAD
    private string $name;
    private int $mode;
    private string|int|bool|array|null|float $default;
    private string $description;
=======
    private $name;
    private $mode;
    private $default;
    private $description;
>>>>>>> origin/New-FakeMain

    /**
     * @param string                           $name        The argument name
     * @param int|null                         $mode        The argument mode: self::REQUIRED or self::OPTIONAL
     * @param string                           $description A description text
     * @param string|bool|int|float|array|null $default     The default value (for self::OPTIONAL mode only)
     *
     * @throws InvalidArgumentException When argument mode is not valid
     */
<<<<<<< HEAD
    public function __construct(string $name, int $mode = null, string $description = '', string|bool|int|float|array $default = null)
=======
    public function __construct(string $name, int $mode = null, string $description = '', $default = null)
>>>>>>> origin/New-FakeMain
    {
        if (null === $mode) {
            $mode = self::OPTIONAL;
        } elseif ($mode > 7 || $mode < 1) {
            throw new InvalidArgumentException(sprintf('Argument mode "%s" is not valid.', $mode));
        }

        $this->name = $name;
        $this->mode = $mode;
        $this->description = $description;

        $this->setDefault($default);
    }

    /**
     * Returns the argument name.
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
     * Returns true if the argument is required.
     *
     * @return bool true if parameter mode is self::REQUIRED, false otherwise
     */
<<<<<<< HEAD
    public function isRequired(): bool
=======
    public function isRequired()
>>>>>>> origin/New-FakeMain
    {
        return self::REQUIRED === (self::REQUIRED & $this->mode);
    }

    /**
     * Returns true if the argument can take multiple values.
     *
     * @return bool true if mode is self::IS_ARRAY, false otherwise
     */
<<<<<<< HEAD
    public function isArray(): bool
=======
    public function isArray()
>>>>>>> origin/New-FakeMain
    {
        return self::IS_ARRAY === (self::IS_ARRAY & $this->mode);
    }

    /**
     * Sets the default value.
     *
<<<<<<< HEAD
     * @throws LogicException When incorrect default value is given
     */
    public function setDefault(string|bool|int|float|array $default = null)
=======
     * @param string|bool|int|float|array|null $default
     *
     * @throws LogicException When incorrect default value is given
     */
    public function setDefault($default = null)
>>>>>>> origin/New-FakeMain
    {
        if (self::REQUIRED === $this->mode && null !== $default) {
            throw new LogicException('Cannot set a default value except for InputArgument::OPTIONAL mode.');
        }

        if ($this->isArray()) {
            if (null === $default) {
                $default = [];
            } elseif (!\is_array($default)) {
                throw new LogicException('A default value for an array argument must be an array.');
            }
        }

        $this->default = $default;
    }

    /**
     * Returns the default value.
<<<<<<< HEAD
     */
    public function getDefault(): string|bool|int|float|array|null
=======
     *
     * @return string|bool|int|float|array|null
     */
    public function getDefault()
>>>>>>> origin/New-FakeMain
    {
        return $this->default;
    }

    /**
     * Returns the description text.
<<<<<<< HEAD
     */
    public function getDescription(): string
=======
     *
     * @return string
     */
    public function getDescription()
>>>>>>> origin/New-FakeMain
    {
        return $this->description;
    }
}
