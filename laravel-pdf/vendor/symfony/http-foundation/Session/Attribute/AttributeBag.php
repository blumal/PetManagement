<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Attribute;

/**
 * This class relates to session attribute storage.
 *
 * @implements \IteratorAggregate<string, mixed>
 */
class AttributeBag implements AttributeBagInterface, \IteratorAggregate, \Countable
{
<<<<<<< HEAD
    private string $name = 'attributes';
    private string $storageKey;
=======
    private $name = 'attributes';
    private $storageKey;
>>>>>>> origin/New-FakeMain

    protected $attributes = [];

    /**
     * @param string $storageKey The key used to store attributes in the session
     */
    public function __construct(string $storageKey = '_sf2_attributes')
    {
        $this->storageKey = $storageKey;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getName(): string
=======
    public function getName()
>>>>>>> origin/New-FakeMain
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array &$attributes)
    {
        $this->attributes = &$attributes;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getStorageKey(): string
=======
    public function getStorageKey()
>>>>>>> origin/New-FakeMain
    {
        return $this->storageKey;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has(string $name): bool
=======
    public function has(string $name)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($name, $this->attributes);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function get(string $name, mixed $default = null): mixed
=======
    public function get(string $name, $default = null)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($name, $this->attributes) ? $this->attributes[$name] : $default;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function set(string $name, mixed $value)
=======
    public function set(string $name, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->attributes[$name] = $value;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function all(): array
=======
    public function all()
>>>>>>> origin/New-FakeMain
    {
        return $this->attributes;
    }

    /**
     * {@inheritdoc}
     */
    public function replace(array $attributes)
    {
        $this->attributes = [];
        foreach ($attributes as $key => $value) {
            $this->set($key, $value);
        }
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function remove(string $name): mixed
=======
    public function remove(string $name)
>>>>>>> origin/New-FakeMain
    {
        $retval = null;
        if (\array_key_exists($name, $this->attributes)) {
            $retval = $this->attributes[$name];
            unset($this->attributes[$name]);
        }

        return $retval;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function clear(): mixed
=======
    public function clear()
>>>>>>> origin/New-FakeMain
    {
        $return = $this->attributes;
        $this->attributes = [];

        return $return;
    }

    /**
     * Returns an iterator for attributes.
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
        return new \ArrayIterator($this->attributes);
    }

    /**
     * Returns the number of attributes.
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
        return \count($this->attributes);
    }
}
