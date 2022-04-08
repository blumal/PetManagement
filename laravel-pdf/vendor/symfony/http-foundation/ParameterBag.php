<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

use Symfony\Component\HttpFoundation\Exception\BadRequestException;

/**
 * ParameterBag is a container for key/value pairs.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @implements \IteratorAggregate<string, mixed>
 */
class ParameterBag implements \IteratorAggregate, \Countable
{
    /**
     * Parameter storage.
     */
    protected $parameters;

    public function __construct(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Returns the parameters.
     *
     * @param string|null $key The name of the parameter to return or null to get them all
<<<<<<< HEAD
     */
    public function all(string $key = null): array
    {
=======
     *
     * @return array
     */
    public function all(/*string $key = null*/)
    {
        $key = \func_num_args() > 0 ? func_get_arg(0) : null;

>>>>>>> origin/New-FakeMain
        if (null === $key) {
            return $this->parameters;
        }

        if (!\is_array($value = $this->parameters[$key] ?? [])) {
            throw new BadRequestException(sprintf('Unexpected value for parameter "%s": expecting "array", got "%s".', $key, get_debug_type($value)));
        }

        return $value;
    }

    /**
     * Returns the parameter keys.
<<<<<<< HEAD
     */
    public function keys(): array
=======
     *
     * @return array
     */
    public function keys()
>>>>>>> origin/New-FakeMain
    {
        return array_keys($this->parameters);
    }

    /**
     * Replaces the current parameters by a new set.
     */
    public function replace(array $parameters = [])
    {
        $this->parameters = $parameters;
    }

    /**
     * Adds parameters.
     */
    public function add(array $parameters = [])
    {
        $this->parameters = array_replace($this->parameters, $parameters);
    }

<<<<<<< HEAD
    public function get(string $key, mixed $default = null): mixed
=======
    /**
     * Returns a parameter by name.
     *
     * @param mixed $default The default value if the parameter key does not exist
     *
     * @return mixed
     */
    public function get(string $key, $default = null)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($key, $this->parameters) ? $this->parameters[$key] : $default;
    }

<<<<<<< HEAD
    public function set(string $key, mixed $value)
=======
    /**
     * Sets a parameter by name.
     *
     * @param mixed $value The value
     */
    public function set(string $key, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Returns true if the parameter is defined.
<<<<<<< HEAD
     */
    public function has(string $key): bool
=======
     *
     * @return bool
     */
    public function has(string $key)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($key, $this->parameters);
    }

    /**
     * Removes a parameter.
     */
    public function remove(string $key)
    {
        unset($this->parameters[$key]);
    }

    /**
     * Returns the alphabetic characters of the parameter value.
<<<<<<< HEAD
     */
    public function getAlpha(string $key, string $default = ''): string
=======
     *
     * @return string
     */
    public function getAlpha(string $key, string $default = '')
>>>>>>> origin/New-FakeMain
    {
        return preg_replace('/[^[:alpha:]]/', '', $this->get($key, $default));
    }

    /**
     * Returns the alphabetic characters and digits of the parameter value.
<<<<<<< HEAD
     */
    public function getAlnum(string $key, string $default = ''): string
=======
     *
     * @return string
     */
    public function getAlnum(string $key, string $default = '')
>>>>>>> origin/New-FakeMain
    {
        return preg_replace('/[^[:alnum:]]/', '', $this->get($key, $default));
    }

    /**
     * Returns the digits of the parameter value.
<<<<<<< HEAD
     */
    public function getDigits(string $key, string $default = ''): string
=======
     *
     * @return string
     */
    public function getDigits(string $key, string $default = '')
>>>>>>> origin/New-FakeMain
    {
        // we need to remove - and + because they're allowed in the filter
        return str_replace(['-', '+'], '', $this->filter($key, $default, \FILTER_SANITIZE_NUMBER_INT));
    }

    /**
     * Returns the parameter value converted to integer.
<<<<<<< HEAD
     */
    public function getInt(string $key, int $default = 0): int
=======
     *
     * @return int
     */
    public function getInt(string $key, int $default = 0)
>>>>>>> origin/New-FakeMain
    {
        return (int) $this->get($key, $default);
    }

    /**
     * Returns the parameter value converted to boolean.
<<<<<<< HEAD
     */
    public function getBoolean(string $key, bool $default = false): bool
=======
     *
     * @return bool
     */
    public function getBoolean(string $key, bool $default = false)
>>>>>>> origin/New-FakeMain
    {
        return $this->filter($key, $default, \FILTER_VALIDATE_BOOLEAN);
    }

    /**
     * Filter key.
     *
<<<<<<< HEAD
     * @param int $filter FILTER_* constant
     *
     * @see https://php.net/filter-var
     */
    public function filter(string $key, mixed $default = null, int $filter = \FILTER_DEFAULT, mixed $options = []): mixed
=======
     * @param mixed $default Default = null
     * @param int   $filter  FILTER_* constant
     * @param mixed $options Filter options
     *
     * @see https://php.net/filter-var
     *
     * @return mixed
     */
    public function filter(string $key, $default = null, int $filter = \FILTER_DEFAULT, $options = [])
>>>>>>> origin/New-FakeMain
    {
        $value = $this->get($key, $default);

        // Always turn $options into an array - this allows filter_var option shortcuts.
        if (!\is_array($options) && $options) {
            $options = ['flags' => $options];
        }

        // Add a convenience check for arrays.
        if (\is_array($value) && !isset($options['flags'])) {
            $options['flags'] = \FILTER_REQUIRE_ARRAY;
        }

        if ((\FILTER_CALLBACK & $filter) && !(($options['options'] ?? null) instanceof \Closure)) {
<<<<<<< HEAD
            throw new \InvalidArgumentException(sprintf('A Closure must be passed to "%s()" when FILTER_CALLBACK is used, "%s" given.', __METHOD__, get_debug_type($options['options'] ?? null)));
=======
            trigger_deprecation('symfony/http-foundation', '5.2', 'Not passing a Closure together with FILTER_CALLBACK to "%s()" is deprecated. Wrap your filter in a closure instead.', __METHOD__);
            // throw new \InvalidArgumentException(sprintf('A Closure must be passed to "%s()" when FILTER_CALLBACK is used, "%s" given.', __METHOD__, get_debug_type($options['options'] ?? null)));
>>>>>>> origin/New-FakeMain
        }

        return filter_var($value, $filter, $options);
    }

    /**
     * Returns an iterator for parameters.
     *
     * @return \ArrayIterator<string, mixed>
     */
<<<<<<< HEAD
    public function getIterator(): \ArrayIterator
=======
    #[\ReturnTypeWillChange]
    public function getIterator()
>>>>>>> origin/New-FakeMain
    {
        return new \ArrayIterator($this->parameters);
    }

    /**
     * Returns the number of parameters.
<<<<<<< HEAD
     */
    public function count(): int
=======
     *
     * @return int
     */
    #[\ReturnTypeWillChange]
    public function count()
>>>>>>> origin/New-FakeMain
    {
        return \count($this->parameters);
    }
}
