<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

use Symfony\Contracts\EventDispatcher\Event;

/**
 * Event encapsulation class.
 *
 * Encapsulates events thus decoupling the observer from the subject they encapsulate.
 *
 * @author Drak <drak@zikula.org>
 *
 * @implements \ArrayAccess<string, mixed>
 * @implements \IteratorAggregate<string, mixed>
 */
class GenericEvent extends Event implements \ArrayAccess, \IteratorAggregate
{
    protected $subject;
    protected $arguments;

    /**
     * Encapsulate an event with $subject and $args.
     *
     * @param mixed $subject   The subject of the event, usually an object or a callable
     * @param array $arguments Arguments to store in the event
     */
<<<<<<< HEAD
    public function __construct(mixed $subject = null, array $arguments = [])
=======
    public function __construct($subject = null, array $arguments = [])
>>>>>>> origin/New-FakeMain
    {
        $this->subject = $subject;
        $this->arguments = $arguments;
    }

    /**
     * Getter for subject property.
<<<<<<< HEAD
     */
    public function getSubject(): mixed
=======
     *
     * @return mixed
     */
    public function getSubject()
>>>>>>> origin/New-FakeMain
    {
        return $this->subject;
    }

    /**
     * Get argument by key.
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException if key is not found
     */
    public function getArgument(string $key): mixed
=======
     * @return mixed
     *
     * @throws \InvalidArgumentException if key is not found
     */
    public function getArgument(string $key)
>>>>>>> origin/New-FakeMain
    {
        if ($this->hasArgument($key)) {
            return $this->arguments[$key];
        }

        throw new \InvalidArgumentException(sprintf('Argument "%s" not found.', $key));
    }

    /**
     * Add argument to event.
     *
<<<<<<< HEAD
     * @return $this
     */
    public function setArgument(string $key, mixed $value): static
=======
     * @param mixed $value Value
     *
     * @return $this
     */
    public function setArgument(string $key, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->arguments[$key] = $value;

        return $this;
    }

    /**
     * Getter for all arguments.
<<<<<<< HEAD
     */
    public function getArguments(): array
=======
     *
     * @return array
     */
    public function getArguments()
>>>>>>> origin/New-FakeMain
    {
        return $this->arguments;
    }

    /**
     * Set args property.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setArguments(array $args = []): static
=======
    public function setArguments(array $args = [])
>>>>>>> origin/New-FakeMain
    {
        $this->arguments = $args;

        return $this;
    }

    /**
     * Has argument.
<<<<<<< HEAD
     */
    public function hasArgument(string $key): bool
=======
     *
     * @return bool
     */
    public function hasArgument(string $key)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($key, $this->arguments);
    }

    /**
     * ArrayAccess for argument getter.
     *
     * @param string $key Array key
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException if key does not exist in $this->args
     */
    public function offsetGet(mixed $key): mixed
=======
     * @return mixed
     *
     * @throws \InvalidArgumentException if key does not exist in $this->args
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($key)
>>>>>>> origin/New-FakeMain
    {
        return $this->getArgument($key);
    }

    /**
     * ArrayAccess for argument setter.
     *
<<<<<<< HEAD
     * @param string $key Array key to set
     */
    public function offsetSet(mixed $key, mixed $value): void
=======
     * @param string $key   Array key to set
     * @param mixed  $value Value
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($key, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->setArgument($key, $value);
    }

    /**
     * ArrayAccess for unset argument.
     *
     * @param string $key Array key
<<<<<<< HEAD
     */
    public function offsetUnset(mixed $key): void
=======
     *
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($key)
>>>>>>> origin/New-FakeMain
    {
        if ($this->hasArgument($key)) {
            unset($this->arguments[$key]);
        }
    }

    /**
     * ArrayAccess has argument.
     *
     * @param string $key Array key
<<<<<<< HEAD
     */
    public function offsetExists(mixed $key): bool
=======
     *
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($key)
>>>>>>> origin/New-FakeMain
    {
        return $this->hasArgument($key);
    }

    /**
     * IteratorAggregate for iterating over the object like an array.
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
        return new \ArrayIterator($this->arguments);
    }
}
