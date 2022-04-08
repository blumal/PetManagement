<?php

namespace Illuminate\Database\Eloquent\Factories;

trait HasFactory
{
    /**
     * Get a new factory instance for the model.
     *
<<<<<<< HEAD
     * @param  callable|array|int|null  $count
     * @param  callable|array  $state
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
     */
    public static function factory($count = null, $state = [])
=======
     * @param  mixed  $parameters
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public static function factory(...$parameters)
>>>>>>> origin/New-FakeMain
    {
        $factory = static::newFactory() ?: Factory::factoryForModel(get_called_class());

        return $factory
<<<<<<< HEAD
                    ->count(is_numeric($count) ? $count : null)
                    ->state(is_callable($count) || is_array($count) ? $count : $state);
=======
                    ->count(is_numeric($parameters[0] ?? null) ? $parameters[0] : null)
                    ->state(is_array($parameters[0] ?? null) ? $parameters[0] : ($parameters[1] ?? []));
>>>>>>> origin/New-FakeMain
    }

    /**
     * Create a new factory instance for the model.
     *
<<<<<<< HEAD
     * @return \Illuminate\Database\Eloquent\Factories\Factory<static>
=======
     * @return \Illuminate\Database\Eloquent\Factories\Factory
>>>>>>> origin/New-FakeMain
     */
    protected static function newFactory()
    {
        //
    }
}
