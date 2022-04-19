<?php

namespace Illuminate\Support;

use ArrayAccess;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use JsonSerializable;

<<<<<<< HEAD
/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 * @implements \ArrayAccess<TKey, TValue>
 */
=======
>>>>>>> origin/New-FakeMain
class Fluent implements Arrayable, ArrayAccess, Jsonable, JsonSerializable
{
    /**
     * All of the attributes set on the fluent instance.
     *
<<<<<<< HEAD
     * @var array<TKey, TValue>
=======
     * @var array
>>>>>>> origin/New-FakeMain
     */
    protected $attributes = [];

    /**
     * Create a new fluent instance.
     *
<<<<<<< HEAD
     * @param  iterable<TKey, TValue>  $attributes
=======
     * @param  array|object  $attributes
>>>>>>> origin/New-FakeMain
     * @return void
     */
    public function __construct($attributes = [])
    {
        foreach ($attributes as $key => $value) {
            $this->attributes[$key] = $value;
        }
    }

    /**
     * Get an attribute from the fluent instance.
     *
<<<<<<< HEAD
     * @template TGetDefault
     *
     * @param  TKey  $key
     * @param  TGetDefault|(\Closure(): TGetDefault)  $default
     * @return TValue|TGetDefault
=======
     * @param  string  $key
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->attributes)) {
            return $this->attributes[$key];
        }

        return value($default);
    }

    /**
     * Get the attributes from the fluent instance.
     *
<<<<<<< HEAD
     * @return array<TKey, TValue>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function getAttributes()
    {
        return $this->attributes;
    }

    /**
     * Convert the fluent instance to an array.
     *
<<<<<<< HEAD
     * @return array<TKey, TValue>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function toArray()
    {
        return $this->attributes;
    }

    /**
     * Convert the object into something JSON serializable.
     *
<<<<<<< HEAD
     * @return array<TKey, TValue>
     */
    public function jsonSerialize(): array
=======
     * @return array
     */
    #[\ReturnTypeWillChange]
    public function jsonSerialize()
>>>>>>> origin/New-FakeMain
    {
        return $this->toArray();
    }

    /**
     * Convert the fluent instance to JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0)
    {
        return json_encode($this->jsonSerialize(), $options);
    }

    /**
     * Determine if the given offset exists.
     *
<<<<<<< HEAD
     * @param  TKey  $offset
     * @return bool
     */
    public function offsetExists($offset): bool
=======
     * @param  string  $offset
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->attributes[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
<<<<<<< HEAD
     * @param  TKey  $offset
     * @return TValue|null
     */
    public function offsetGet($offset): mixed
=======
     * @param  string  $offset
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
>>>>>>> origin/New-FakeMain
    {
        return $this->get($offset);
    }

    /**
     * Set the value at the given offset.
     *
<<<<<<< HEAD
     * @param  TKey  $offset
     * @param  TValue  $value
     * @return void
     */
    public function offsetSet($offset, $value): void
=======
     * @param  string  $offset
     * @param  mixed  $value
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->attributes[$offset] = $value;
    }

    /**
     * Unset the value at the given offset.
     *
<<<<<<< HEAD
     * @param  TKey  $offset
     * @return void
     */
    public function offsetUnset($offset): void
=======
     * @param  string  $offset
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
>>>>>>> origin/New-FakeMain
    {
        unset($this->attributes[$offset]);
    }

    /**
     * Handle dynamic calls to the fluent instance to set attributes.
     *
<<<<<<< HEAD
     * @param  TKey  $method
     * @param  array{0: ?TValue}  $parameters
=======
     * @param  string  $method
     * @param  array  $parameters
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function __call($method, $parameters)
    {
        $this->attributes[$method] = count($parameters) > 0 ? $parameters[0] : true;

        return $this;
    }

    /**
     * Dynamically retrieve the value of an attribute.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @return TValue|null
=======
     * @param  string  $key
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function __get($key)
    {
        return $this->get($key);
    }

    /**
     * Dynamically set the value of an attribute.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @param  TValue  $value
=======
     * @param  string  $key
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return void
     */
    public function __set($key, $value)
    {
        $this->offsetSet($key, $value);
    }

    /**
     * Dynamically check if an attribute is set.
     *
<<<<<<< HEAD
     * @param  TKey  $key
=======
     * @param  string  $key
>>>>>>> origin/New-FakeMain
     * @return bool
     */
    public function __isset($key)
    {
        return $this->offsetExists($key);
    }

    /**
     * Dynamically unset an attribute.
     *
<<<<<<< HEAD
     * @param  TKey  $key
=======
     * @param  string  $key
>>>>>>> origin/New-FakeMain
     * @return void
     */
    public function __unset($key)
    {
        $this->offsetUnset($key);
    }
}
