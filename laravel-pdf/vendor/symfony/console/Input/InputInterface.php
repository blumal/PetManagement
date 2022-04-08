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
use Symfony\Component\Console\Exception\RuntimeException;

/**
 * InputInterface is the interface implemented by all input classes.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface InputInterface
{
    /**
     * Returns the first argument from the raw parameters (not parsed).
<<<<<<< HEAD
     */
    public function getFirstArgument(): ?string;
=======
     *
     * @return string|null
     */
    public function getFirstArgument();
>>>>>>> origin/New-FakeMain

    /**
     * Returns true if the raw parameters (not parsed) contain a value.
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array $values     The values to look for in the raw parameters (can be an array)
     * @param bool         $onlyParams Only check real parameters, skip those following an end of options (--) signal
<<<<<<< HEAD
     */
    public function hasParameterOption(string|array $values, bool $onlyParams = false): bool;
=======
     *
     * @return bool
     */
    public function hasParameterOption($values, bool $onlyParams = false);
>>>>>>> origin/New-FakeMain

    /**
     * Returns the value of a raw option (not parsed).
     *
     * This method is to be used to introspect the input parameters
     * before they have been validated. It must be used carefully.
     * Does not necessarily return the correct result for short options
     * when multiple flags are combined in the same option.
     *
     * @param string|array                     $values     The value(s) to look for in the raw parameters (can be an array)
     * @param string|bool|int|float|array|null $default    The default value to return if no result is found
     * @param bool                             $onlyParams Only check real parameters, skip those following an end of options (--) signal
     *
     * @return mixed
     */
<<<<<<< HEAD
    public function getParameterOption(string|array $values, string|bool|int|float|array|null $default = false, bool $onlyParams = false);
=======
    public function getParameterOption($values, $default = false, bool $onlyParams = false);
>>>>>>> origin/New-FakeMain

    /**
     * Binds the current Input instance with the given arguments and options.
     *
     * @throws RuntimeException
     */
    public function bind(InputDefinition $definition);

    /**
     * Validates the input.
     *
     * @throws RuntimeException When not enough arguments are given
     */
    public function validate();

    /**
     * Returns all the given arguments merged with the default values.
     *
     * @return array<string|bool|int|float|array|null>
     */
<<<<<<< HEAD
    public function getArguments(): array;
=======
    public function getArguments();
>>>>>>> origin/New-FakeMain

    /**
     * Returns the argument value for a given argument name.
     *
     * @return mixed
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function getArgument(string $name);

    /**
     * Sets an argument value by name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, mixed $value);

    /**
     * Returns true if an InputArgument object exists by name or position.
     */
    public function hasArgument(string $name): bool;
=======
     * @param mixed $value The argument value
     *
     * @throws InvalidArgumentException When argument given doesn't exist
     */
    public function setArgument(string $name, $value);

    /**
     * Returns true if an InputArgument object exists by name or position.
     *
     * @return bool
     */
    public function hasArgument(string $name);
>>>>>>> origin/New-FakeMain

    /**
     * Returns all the given options merged with the default values.
     *
     * @return array<string|bool|int|float|array|null>
     */
<<<<<<< HEAD
    public function getOptions(): array;
=======
    public function getOptions();
>>>>>>> origin/New-FakeMain

    /**
     * Returns the option value for a given option name.
     *
     * @return mixed
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function getOption(string $name);

    /**
     * Sets an option value by name.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, mixed $value);

    /**
     * Returns true if an InputOption object exists by name.
     */
    public function hasOption(string $name): bool;

    /**
     * Is this input means interactive?
     */
    public function isInteractive(): bool;
=======
     * @param mixed $value The option value
     *
     * @throws InvalidArgumentException When option given doesn't exist
     */
    public function setOption(string $name, $value);

    /**
     * Returns true if an InputOption object exists by name.
     *
     * @return bool
     */
    public function hasOption(string $name);

    /**
     * Is this input means interactive?
     *
     * @return bool
     */
    public function isInteractive();
>>>>>>> origin/New-FakeMain

    /**
     * Sets the input interactivity.
     */
    public function setInteractive(bool $interactive);
}
