<?php

namespace Illuminate\Http\Resources;

use Exception;
use Illuminate\Support\Traits\ForwardsCalls;
<<<<<<< HEAD
use Illuminate\Support\Traits\Macroable;

trait DelegatesToResource
{
    use ForwardsCalls, Macroable {
        __call as macroCall;
    }
=======

trait DelegatesToResource
{
    use ForwardsCalls;
>>>>>>> origin/New-FakeMain

    /**
     * Get the value of the resource's route key.
     *
     * @return mixed
     */
    public function getRouteKey()
    {
        return $this->resource->getRouteKey();
    }

    /**
     * Get the route key for the resource.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return $this->resource->getRouteKeyName();
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  mixed  $value
     * @param  string|null  $field
     * @return void
     *
     * @throws \Exception
     */
    public function resolveRouteBinding($value, $field = null)
    {
        throw new Exception('Resources may not be implicitly resolved from route bindings.');
    }

    /**
     * Retrieve the model for a bound value.
     *
     * @param  string  $childType
     * @param  mixed  $value
     * @param  string|null  $field
     * @return void
     *
     * @throws \Exception
     */
    public function resolveChildRouteBinding($childType, $value, $field = null)
    {
        throw new Exception('Resources may not be implicitly resolved from route bindings.');
    }

    /**
     * Determine if the given attribute exists.
     *
     * @param  mixed  $offset
     * @return bool
     */
<<<<<<< HEAD
    public function offsetExists($offset): bool
=======
    #[\ReturnTypeWillChange]
    public function offsetExists($offset)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->resource[$offset]);
    }

    /**
     * Get the value for a given offset.
     *
     * @param  mixed  $offset
     * @return mixed
     */
<<<<<<< HEAD
    public function offsetGet($offset): mixed
=======
    #[\ReturnTypeWillChange]
    public function offsetGet($offset)
>>>>>>> origin/New-FakeMain
    {
        return $this->resource[$offset];
    }

    /**
     * Set the value for a given offset.
     *
     * @param  mixed  $offset
     * @param  mixed  $value
     * @return void
     */
<<<<<<< HEAD
    public function offsetSet($offset, $value): void
=======
    #[\ReturnTypeWillChange]
    public function offsetSet($offset, $value)
>>>>>>> origin/New-FakeMain
    {
        $this->resource[$offset] = $value;
    }

    /**
     * Unset the value for a given offset.
     *
     * @param  mixed  $offset
     * @return void
     */
<<<<<<< HEAD
    public function offsetUnset($offset): void
=======
    #[\ReturnTypeWillChange]
    public function offsetUnset($offset)
>>>>>>> origin/New-FakeMain
    {
        unset($this->resource[$offset]);
    }

    /**
     * Determine if an attribute exists on the resource.
     *
     * @param  string  $key
     * @return bool
     */
    public function __isset($key)
    {
        return isset($this->resource->{$key});
    }

    /**
     * Unset an attribute on the resource.
     *
     * @param  string  $key
     * @return void
     */
    public function __unset($key)
    {
        unset($this->resource->{$key});
    }

    /**
     * Dynamically get properties from the underlying resource.
     *
     * @param  string  $key
     * @return mixed
     */
    public function __get($key)
    {
        return $this->resource->{$key};
    }

    /**
     * Dynamically pass method calls to the underlying resource.
     *
     * @param  string  $method
     * @param  array  $parameters
     * @return mixed
     */
    public function __call($method, $parameters)
    {
<<<<<<< HEAD
        if (static::hasMacro($method)) {
            return $this->macroCall($method, $parameters);
        }

=======
>>>>>>> origin/New-FakeMain
        return $this->forwardCallTo($this->resource, $method, $parameters);
    }
}
