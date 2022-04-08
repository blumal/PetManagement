<?php

namespace Illuminate\Routing;

use Illuminate\Support\Reflector;
use Illuminate\Support\Str;
use ReflectionFunction;
use ReflectionMethod;

class RouteSignatureParameters
{
    /**
     * Extract the route action's signature parameters.
     *
     * @param  array  $action
<<<<<<< HEAD
     * @param  array  $conditions
     * @return array
     */
    public static function fromAction(array $action, $conditions = [])
=======
     * @param  string|null  $subClass
     * @return array
     */
    public static function fromAction(array $action, $subClass = null)
>>>>>>> origin/New-FakeMain
    {
        $callback = RouteAction::containsSerializedClosure($action)
                        ? unserialize($action['uses'])->getClosure()
                        : $action['uses'];

        $parameters = is_string($callback)
                        ? static::fromClassMethodString($callback)
                        : (new ReflectionFunction($callback))->getParameters();

<<<<<<< HEAD
        return match (true) {
            ! empty($conditions['subClass']) => array_filter($parameters, fn ($p) => Reflector::isParameterSubclassOf($p, $conditions['subClass'])),
            ! empty($conditions['backedEnum']) => array_filter($parameters, fn ($p) => Reflector::isParameterBackedEnumWithStringBackingType($p)),
            default => $parameters,
        };
=======
        return is_null($subClass) ? $parameters : array_filter($parameters, function ($p) use ($subClass) {
            return Reflector::isParameterSubclassOf($p, $subClass);
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the parameters for the given class / method by string.
     *
     * @param  string  $uses
     * @return array
     */
    protected static function fromClassMethodString($uses)
    {
        [$class, $method] = Str::parseCallback($uses);

        if (! method_exists($class, $method) && Reflector::isCallable($class, $method)) {
            return [];
        }

        return (new ReflectionMethod($class, $method))->getParameters();
    }
}
