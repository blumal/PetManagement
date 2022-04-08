<?php

namespace Illuminate\Support;

<<<<<<< HEAD
use CachingIterator;
=======
>>>>>>> origin/New-FakeMain
use Countable;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Contracts\Support\Jsonable;
use IteratorAggregate;
use JsonSerializable;
<<<<<<< HEAD
use Traversable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @extends \Illuminate\Contracts\Support\Arrayable<TKey, TValue>
 * @extends \IteratorAggregate<TKey, TValue>
 */
=======

>>>>>>> origin/New-FakeMain
interface Enumerable extends Arrayable, Countable, IteratorAggregate, Jsonable, JsonSerializable
{
    /**
     * Create a new collection instance if the value isn't one already.
     *
<<<<<<< HEAD
     * @template TMakeKey of array-key
     * @template TMakeValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<TMakeKey, TMakeValue>|iterable<TMakeKey, TMakeValue>|null  $items
     * @return static<TMakeKey, TMakeValue>
=======
     * @param  mixed  $items
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public static function make($items = []);

    /**
     * Create a new instance by invoking the callback a given amount of times.
     *
     * @param  int  $number
     * @param  callable|null  $callback
     * @return static
     */
    public static function times($number, callable $callback = null);

    /**
     * Create a collection with the given range.
     *
     * @param  int  $from
     * @param  int  $to
     * @return static
     */
    public static function range($from, $to);

    /**
     * Wrap the given value in a collection if applicable.
     *
<<<<<<< HEAD
     * @template TWrapKey of array-key
     * @template TWrapValue
     *
     * @param  iterable<TWrapKey, TWrapValue>  $value
     * @return static<TWrapKey, TWrapValue>
=======
     * @param  mixed  $value
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public static function wrap($value);

    /**
     * Get the underlying items from the given collection if applicable.
     *
<<<<<<< HEAD
     * @template TUnwrapKey of array-key
     * @template TUnwrapValue
     *
     * @param  array<TUnwrapKey, TUnwrapValue>|static<TUnwrapKey, TUnwrapValue>  $value
     * @return array<TUnwrapKey, TUnwrapValue>
=======
     * @param  array|static  $value
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public static function unwrap($value);

    /**
     * Create a new instance with no items.
     *
     * @return static
     */
    public static function empty();

    /**
     * Get all items in the enumerable.
     *
     * @return array
     */
    public function all();

    /**
     * Alias for the "avg" method.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): float|int)|string|null  $callback
     * @return float|int|null
=======
     * @param  callable|string|null  $callback
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function average($callback = null);

    /**
     * Get the median of a given key.
     *
<<<<<<< HEAD
     * @param  string|array<array-key, string>|null  $key
     * @return float|int|null
=======
     * @param  string|array|null  $key
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function median($key = null);

    /**
     * Get the mode of a given key.
     *
<<<<<<< HEAD
     * @param  string|array<array-key, string>|null  $key
     * @return array<int, float|int>|null
=======
     * @param  string|array|null  $key
     * @return array|null
>>>>>>> origin/New-FakeMain
     */
    public function mode($key = null);

    /**
     * Collapse the items into a single enumerable.
     *
<<<<<<< HEAD
     * @return static<int, mixed>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function collapse();

    /**
     * Alias for the "contains" method.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|TValue|string  $key
=======
     * @param  mixed  $key
>>>>>>> origin/New-FakeMain
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function some($key, $operator = null, $value = null);

    /**
     * Determine if an item exists, using strict comparison.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|TValue|array-key  $key
     * @param  TValue|null  $value
=======
     * @param  mixed  $key
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return bool
     */
    public function containsStrict($key, $value = null);

    /**
     * Get the average value of a given key.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): float|int)|string|null  $callback
     * @return float|int|null
=======
     * @param  callable|string|null  $callback
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function avg($callback = null);

    /**
     * Determine if an item exists in the enumerable.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|TValue|string  $key
=======
     * @param  mixed  $key
>>>>>>> origin/New-FakeMain
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function contains($key, $operator = null, $value = null);

    /**
<<<<<<< HEAD
     * Determine if an item is not contained in the collection.
     *
     * @param  mixed  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function doesntContain($key, $operator = null, $value = null);

    /**
     * Cross join with the given lists, returning all possible permutations.
     *
     * @template TCrossJoinKey
     * @template TCrossJoinValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<TCrossJoinKey, TCrossJoinValue>|iterable<TCrossJoinKey, TCrossJoinValue>  ...$lists
     * @return static<int, array<int, TValue|TCrossJoinValue>>
=======
     * Cross join with the given lists, returning all possible permutations.
     *
     * @param  mixed  ...$lists
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function crossJoin(...$lists);

    /**
     * Dump the collection and end the script.
     *
     * @param  mixed  ...$args
<<<<<<< HEAD
     * @return never
=======
     * @return void
>>>>>>> origin/New-FakeMain
     */
    public function dd(...$args);

    /**
     * Dump the collection.
     *
     * @return $this
     */
    public function dump();

    /**
     * Get the items that are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<array-key, TValue>|iterable<array-key, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diff($items);

    /**
     * Get the items that are not present in the given items, using the callback.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<array-key, TValue>|iterable<array-key, TValue>  $items
     * @param  callable(TValue, TValue): int  $callback
=======
     * @param  mixed  $items
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffUsing($items, callable $callback);

    /**
     * Get the items whose keys and values are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffAssoc($items);

    /**
     * Get the items whose keys and values are not present in the given items, using the callback.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
     * @param  callable(TKey, TKey): int  $callback
=======
     * @param  mixed  $items
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffAssocUsing($items, callable $callback);

    /**
     * Get the items whose keys are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffKeys($items);

    /**
     * Get the items whose keys are not present in the given items, using the callback.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
     * @param  callable(TKey, TKey): int  $callback
=======
     * @param  mixed  $items
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffKeysUsing($items, callable $callback);

    /**
     * Retrieve duplicate items.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|string|null  $callback
=======
     * @param  callable|string|null  $callback
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function duplicates($callback = null, $strict = false);

    /**
     * Retrieve duplicate items using strict comparison.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|string|null  $callback
=======
     * @param  callable|string|null  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function duplicatesStrict($callback = null);

    /**
     * Execute a callback over each item.
     *
<<<<<<< HEAD
     * @param  callable(TValue, TKey): mixed  $callback
=======
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function each(callable $callback);

    /**
     * Execute a callback over each nested chunk of items.
     *
     * @param  callable  $callback
     * @return static
     */
    public function eachSpread(callable $callback);

    /**
     * Determine if all items pass the given truth test.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|TValue|string  $key
=======
     * @param  string|callable  $key
>>>>>>> origin/New-FakeMain
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function every($key, $operator = null, $value = null);

    /**
     * Get all items except for those with the specified keys.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Support\Enumerable<array-key, TKey>|array<array-key, TKey>  $keys
=======
     * @param  mixed  $keys
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function except($keys);

    /**
     * Run a filter over each of the items.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|null  $callback
=======
     * @param  callable|null  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function filter(callable $callback = null);

    /**
<<<<<<< HEAD
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TWhenReturnType as null
     *
     * @param  bool  $value
     * @param  (callable($this): TWhenReturnType)|null  $callback
     * @param  (callable($this): TWhenReturnType)|null  $default
     * @return $this|TWhenReturnType
     */
    public function when($value, callable $callback = null, callable $default = null);
=======
     * Apply the callback if the value is truthy.
     *
     * @param  bool  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
     */
    public function when($value, callable $callback, callable $default = null);
>>>>>>> origin/New-FakeMain

    /**
     * Apply the callback if the collection is empty.
     *
<<<<<<< HEAD
     * @template TWhenEmptyReturnType
     *
     * @param  (callable($this): TWhenEmptyReturnType)  $callback
     * @param  (callable($this): TWhenEmptyReturnType)|null  $default
     * @return $this|TWhenEmptyReturnType
=======
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     */
    public function whenEmpty(callable $callback, callable $default = null);

    /**
     * Apply the callback if the collection is not empty.
     *
<<<<<<< HEAD
     * @template TWhenNotEmptyReturnType
     *
     * @param  callable($this): TWhenNotEmptyReturnType  $callback
     * @param  (callable($this): TWhenNotEmptyReturnType)|null  $default
     * @return $this|TWhenNotEmptyReturnType
=======
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     */
    public function whenNotEmpty(callable $callback, callable $default = null);

    /**
<<<<<<< HEAD
     * Apply the callback if the given "value" is (or resolves to) truthy.
     *
     * @template TUnlessReturnType
     *
     * @param  bool  $value
     * @param  (callable($this): TUnlessReturnType)  $callback
     * @param  (callable($this): TUnlessReturnType)|null  $default
     * @return $this|TUnlessReturnType
=======
     * Apply the callback if the value is falsy.
     *
     * @param  bool  $value
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     */
    public function unless($value, callable $callback, callable $default = null);

    /**
     * Apply the callback unless the collection is empty.
     *
<<<<<<< HEAD
     * @template TUnlessEmptyReturnType
     *
     * @param  callable($this): TUnlessEmptyReturnType  $callback
     * @param  (callable($this): TUnlessEmptyReturnType)|null  $default
     * @return $this|TUnlessEmptyReturnType
=======
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     */
    public function unlessEmpty(callable $callback, callable $default = null);

    /**
     * Apply the callback unless the collection is not empty.
     *
<<<<<<< HEAD
     * @template TUnlessNotEmptyReturnType
     *
     * @param  callable($this): TUnlessNotEmptyReturnType  $callback
     * @param  (callable($this): TUnlessNotEmptyReturnType)|null  $default
     * @return $this|TUnlessNotEmptyReturnType
=======
     * @param  callable  $callback
     * @param  callable|null  $default
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     */
    public function unlessNotEmpty(callable $callback, callable $default = null);

    /**
     * Filter items by the given key value pair.
     *
     * @param  string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return static
     */
    public function where($key, $operator = null, $value = null);

    /**
     * Filter items where the value for the given key is null.
     *
     * @param  string|null  $key
     * @return static
     */
    public function whereNull($key = null);

    /**
     * Filter items where the value for the given key is not null.
     *
     * @param  string|null  $key
     * @return static
     */
    public function whereNotNull($key = null);

    /**
     * Filter items by the given key value pair using strict comparison.
     *
     * @param  string  $key
     * @param  mixed  $value
     * @return static
     */
    public function whereStrict($key, $value);

    /**
     * Filter items by the given key value pair.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  mixed  $values
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function whereIn($key, $values, $strict = false);

    /**
     * Filter items by the given key value pair using strict comparison.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  mixed  $values
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function whereInStrict($key, $values);

    /**
     * Filter items such that the value of the given key is between the given values.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  array  $values
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function whereBetween($key, $values);

    /**
     * Filter items such that the value of the given key is not between the given values.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  array  $values
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function whereNotBetween($key, $values);

    /**
     * Filter items by the given key value pair.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  mixed  $values
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function whereNotIn($key, $values, $strict = false);

    /**
     * Filter items by the given key value pair using strict comparison.
     *
     * @param  string  $key
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable|iterable  $values
=======
     * @param  mixed  $values
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function whereNotInStrict($key, $values);

    /**
     * Filter the items, removing any items that don't match the given type(s).
     *
<<<<<<< HEAD
     * @template TWhereInstanceOf
     *
     * @param  class-string<TWhereInstanceOf>|array<array-key, class-string<TWhereInstanceOf>>  $type
     * @return static<TKey, TWhereInstanceOf>
=======
     * @param  string|string[]  $type
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function whereInstanceOf($type);

    /**
     * Get the first item from the enumerable passing the given truth test.
     *
<<<<<<< HEAD
     * @template TFirstDefault
     *
     * @param  (callable(TValue,TKey): bool)|null  $callback
     * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
     * @return TValue|TFirstDefault
=======
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function first(callable $callback = null, $default = null);

    /**
     * Get the first item by the given key value pair.
     *
     * @param  string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
<<<<<<< HEAD
     * @return TValue|null
=======
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function firstWhere($key, $operator = null, $value = null);

    /**
     * Get a flattened array of the items in the collection.
     *
     * @param  int  $depth
     * @return static
     */
    public function flatten($depth = INF);

    /**
     * Flip the values with their keys.
     *
<<<<<<< HEAD
     * @return static<TValue, TKey>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function flip();

    /**
     * Get an item from the collection by key.
     *
<<<<<<< HEAD
     * @template TGetDefault
     *
     * @param  TKey  $key
     * @param  TGetDefault|(\Closure(): TGetDefault)  $default
     * @return TValue|TGetDefault
=======
     * @param  mixed  $key
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function get($key, $default = null);

    /**
     * Group an associative array by a field or using a callback.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): array-key)|array|string  $groupBy
     * @param  bool  $preserveKeys
     * @return static<array-key, static<array-key, TValue>>
=======
     * @param  array|callable|string  $groupBy
     * @param  bool  $preserveKeys
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function groupBy($groupBy, $preserveKeys = false);

    /**
     * Key an associative array by a field or using a callback.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): array-key)|array|string  $keyBy
     * @return static<array-key, TValue>
=======
     * @param  callable|string  $keyBy
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function keyBy($keyBy);

    /**
     * Determine if an item exists in the collection by key.
     *
<<<<<<< HEAD
     * @param  TKey|array<array-key, TKey>  $key
     * @return bool
     */
    public function has($key);

    /**
     * Determine if any of the keys exist in the collection.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function hasAny($key);
=======
     * @param  mixed  $key
     * @return bool
     */
    public function has($key);
>>>>>>> origin/New-FakeMain

    /**
     * Concatenate values of a given key as a string.
     *
     * @param  string  $value
     * @param  string|null  $glue
     * @return string
     */
    public function implode($value, $glue = null);

    /**
     * Intersect the collection with the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function intersect($items);

    /**
     * Intersect the collection with the given items by key.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function intersectByKeys($items);

    /**
     * Determine if the collection is empty or not.
     *
     * @return bool
     */
    public function isEmpty();

    /**
     * Determine if the collection is not empty.
     *
     * @return bool
     */
    public function isNotEmpty();

    /**
<<<<<<< HEAD
     * Determine if the collection contains a single item.
     *
     * @return bool
     */
    public function containsOneItem();

    /**
=======
>>>>>>> origin/New-FakeMain
     * Join all items from the collection using a string. The final items can use a separate glue string.
     *
     * @param  string  $glue
     * @param  string  $finalGlue
     * @return string
     */
    public function join($glue, $finalGlue = '');

    /**
     * Get the keys of the collection items.
     *
<<<<<<< HEAD
     * @return static<int, TKey>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function keys();

    /**
     * Get the last item from the collection.
     *
<<<<<<< HEAD
     * @template TLastDefault
     *
     * @param  (callable(TValue, TKey): bool)|null  $callback
     * @param  TLastDefault|(\Closure(): TLastDefault)  $default
     * @return TValue|TLastDefault
=======
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function last(callable $callback = null, $default = null);

    /**
     * Run a map over each of the items.
     *
<<<<<<< HEAD
     * @template TMapValue
     *
     * @param  callable(TValue, TKey): TMapValue  $callback
     * @return static<TKey, TMapValue>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function map(callable $callback);

    /**
     * Run a map over each nested chunk of items.
     *
     * @param  callable  $callback
     * @return static
     */
    public function mapSpread(callable $callback);

    /**
     * Run a dictionary map over the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
<<<<<<< HEAD
     * @template TMapToDictionaryKey of array-key
     * @template TMapToDictionaryValue
     *
     * @param  callable(TValue, TKey): array<TMapToDictionaryKey, TMapToDictionaryValue>  $callback
     * @return static<TMapToDictionaryKey, array<int, TMapToDictionaryValue>>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function mapToDictionary(callable $callback);

    /**
     * Run a grouping map over the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
<<<<<<< HEAD
     * @template TMapToGroupsKey of array-key
     * @template TMapToGroupsValue
     *
     * @param  callable(TValue, TKey): array<TMapToGroupsKey, TMapToGroupsValue>  $callback
     * @return static<TMapToGroupsKey, static<int, TMapToGroupsValue>>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function mapToGroups(callable $callback);

    /**
     * Run an associative map over each of the items.
     *
     * The callback should return an associative array with a single key/value pair.
     *
<<<<<<< HEAD
     * @template TMapWithKeysKey of array-key
     * @template TMapWithKeysValue
     *
     * @param  callable(TValue, TKey): array<TMapWithKeysKey, TMapWithKeysValue>  $callback
     * @return static<TMapWithKeysKey, TMapWithKeysValue>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function mapWithKeys(callable $callback);

    /**
     * Map a collection and flatten the result by a single level.
     *
<<<<<<< HEAD
     * @param  callable(TValue, TKey): mixed  $callback
     * @return static<int, mixed>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function flatMap(callable $callback);

    /**
     * Map the values into a new class.
     *
<<<<<<< HEAD
     * @template TMapIntoValue
     *
     * @param  class-string<TMapIntoValue>  $class
     * @return static<TKey, TMapIntoValue>
=======
     * @param  string  $class
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function mapInto($class);

    /**
     * Merge the collection with the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function merge($items);

    /**
     * Recursively merge the collection with the given items.
     *
<<<<<<< HEAD
     * @template TMergeRecursiveValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TMergeRecursiveValue>|iterable<TKey, TMergeRecursiveValue>  $items
     * @return static<TKey, TValue|TMergeRecursiveValue>
=======
     * @param  mixed  $items
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function mergeRecursive($items);

    /**
     * Create a collection by using this collection for keys and another for its values.
     *
<<<<<<< HEAD
     * @template TCombineValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<array-key, TCombineValue>|iterable<array-key, TCombineValue>  $values
     * @return static<TKey, TCombineValue>
=======
     * @param  mixed  $values
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function combine($values);

    /**
     * Union the collection with the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function union($items);

    /**
     * Get the min value of a given key.
     *
<<<<<<< HEAD
     * @param  (callable(TValue):mixed)|string|null  $callback
     * @return TValue
=======
     * @param  callable|string|null  $callback
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function min($callback = null);

    /**
     * Get the max value of a given key.
     *
<<<<<<< HEAD
     * @param  (callable(TValue):mixed)|string|null  $callback
     * @return TValue
=======
     * @param  callable|string|null  $callback
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function max($callback = null);

    /**
     * Create a new collection consisting of every n-th element.
     *
     * @param  int  $step
     * @param  int  $offset
     * @return static
     */
    public function nth($step, $offset = 0);

    /**
     * Get the items with the specified keys.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Support\Enumerable<array-key, TKey>|array<array-key, TKey>|string  $keys
=======
     * @param  mixed  $keys
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function only($keys);

    /**
     * "Paginate" the collection by slicing it into a smaller collection.
     *
     * @param  int  $page
     * @param  int  $perPage
     * @return static
     */
    public function forPage($page, $perPage);

    /**
     * Partition the collection into two arrays using the given callback or key.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|TValue|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return static<int<0, 1>, static<TKey, TValue>>
=======
     * @param  callable|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function partition($key, $operator = null, $value = null);

    /**
     * Push all of the given items onto the collection.
     *
<<<<<<< HEAD
     * @param  iterable<array-key, TValue>  $source
=======
     * @param  iterable  $source
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function concat($source);

    /**
     * Get one or a specified number of items randomly from the collection.
     *
     * @param  int|null  $number
<<<<<<< HEAD
     * @return static<int, TValue>|TValue
=======
     * @return static|mixed
>>>>>>> origin/New-FakeMain
     *
     * @throws \InvalidArgumentException
     */
    public function random($number = null);

    /**
     * Reduce the collection to a single value.
     *
<<<<<<< HEAD
     * @template TReduceInitial
     * @template TReduceReturnType
     *
     * @param  callable(TReduceInitial|TReduceReturnType, TValue, TKey): TReduceReturnType  $callback
     * @param  TReduceInitial  $initial
     * @return TReduceReturnType
=======
     * @param  callable  $callback
     * @param  mixed  $initial
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function reduce(callable $callback, $initial = null);

    /**
<<<<<<< HEAD
     * Reduce the collection to multiple aggregate values.
     *
     * @param  callable  $callback
     * @param  mixed  ...$initial
     * @return array
     *
     * @throws \UnexpectedValueException
     */
    public function reduceSpread(callable $callback, ...$initial);

    /**
     * Replace the collection items with the given items.
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * Replace the collection items with the given items.
     *
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function replace($items);

    /**
     * Recursively replace the collection items with the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function replaceRecursive($items);

    /**
     * Reverse items order.
     *
     * @return static
     */
    public function reverse();

    /**
     * Search the collection for a given value and return the corresponding key if successful.
     *
<<<<<<< HEAD
     * @param  TValue|callable(TValue,TKey): bool  $value
     * @param  bool  $strict
     * @return TKey|bool
=======
     * @param  mixed  $value
     * @param  bool  $strict
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function search($value, $strict = false);

    /**
     * Shuffle the items in the collection.
     *
     * @param  int|null  $seed
     * @return static
     */
    public function shuffle($seed = null);

    /**
<<<<<<< HEAD
     * Create chunks representing a "sliding window" view of the items in the collection.
     *
     * @param  int  $size
     * @param  int  $step
     * @return static<int, static>
     */
    public function sliding($size = 2, $step = 1);

    /**
=======
>>>>>>> origin/New-FakeMain
     * Skip the first {$count} items.
     *
     * @param  int  $count
     * @return static
     */
    public function skip($count);

    /**
     * Skip items in the collection until the given condition is met.
     *
<<<<<<< HEAD
     * @param  TValue|callable(TValue,TKey): bool  $value
=======
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function skipUntil($value);

    /**
     * Skip items in the collection while the given condition is met.
     *
<<<<<<< HEAD
     * @param  TValue|callable(TValue,TKey): bool  $value
=======
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function skipWhile($value);

    /**
     * Get a slice of items from the enumerable.
     *
     * @param  int  $offset
     * @param  int|null  $length
     * @return static
     */
    public function slice($offset, $length = null);

    /**
     * Split a collection into a certain number of groups.
     *
     * @param  int  $numberOfGroups
<<<<<<< HEAD
     * @return static<int, static>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function split($numberOfGroups);

    /**
<<<<<<< HEAD
     * Get the first item in the collection, but only if exactly one item exists. Otherwise, throw an exception.
     *
     * @param  (callable(TValue, TKey): bool)|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return TValue
     *
     * @throws \Illuminate\Support\ItemNotFoundException
     * @throws \Illuminate\Support\MultipleItemsFoundException
     */
    public function sole($key = null, $operator = null, $value = null);

    /**
     * Get the first item in the collection but throw an exception if no matching items exist.
     *
     * @param  (callable(TValue, TKey): bool)|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return TValue
     *
     * @throws \Illuminate\Support\ItemNotFoundException
     */
    public function firstOrFail($key = null, $operator = null, $value = null);

    /**
     * Chunk the collection into chunks of the given size.
     *
     * @param  int  $size
     * @return static<int, static>
=======
     * Chunk the collection into chunks of the given size.
     *
     * @param  int  $size
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function chunk($size);

    /**
     * Chunk the collection into chunks with a callback.
     *
<<<<<<< HEAD
     * @param  callable(TValue, TKey, static<int, TValue>): bool  $callback
     * @return static<int, static<int, TValue>>
=======
     * @param  callable  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function chunkWhile(callable $callback);

    /**
<<<<<<< HEAD
     * Split a collection into a certain number of groups, and fill the first groups completely.
     *
     * @param  int  $numberOfGroups
     * @return static<int, static>
     */
    public function splitIn($numberOfGroups);

    /**
     * Sort through each item with a callback.
     *
     * @param  (callable(TValue, TValue): int)|null|int  $callback
=======
     * Sort through each item with a callback.
     *
     * @param  callable|null|int  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function sort($callback = null);

    /**
     * Sort items in descending order.
     *
     * @param  int  $options
     * @return static
     */
    public function sortDesc($options = SORT_REGULAR);

    /**
     * Sort the collection using the given callback.
     *
<<<<<<< HEAD
     * @param  array<array-key, (callable(TValue, TKey): mixed)|array<array-key, string>|(callable(TValue, TKey): mixed)|string  $callback
=======
     * @param  callable|string  $callback
>>>>>>> origin/New-FakeMain
     * @param  int  $options
     * @param  bool  $descending
     * @return static
     */
    public function sortBy($callback, $options = SORT_REGULAR, $descending = false);

    /**
     * Sort the collection in descending order using the given callback.
     *
<<<<<<< HEAD
     * @param  array<array-key, (callable(TValue, TKey): mixed)|array<array-key, string>|(callable(TValue, TKey): mixed)|string  $callback
=======
     * @param  callable|string  $callback
>>>>>>> origin/New-FakeMain
     * @param  int  $options
     * @return static
     */
    public function sortByDesc($callback, $options = SORT_REGULAR);

    /**
     * Sort the collection keys.
     *
     * @param  int  $options
     * @param  bool  $descending
     * @return static
     */
    public function sortKeys($options = SORT_REGULAR, $descending = false);

    /**
     * Sort the collection keys in descending order.
     *
     * @param  int  $options
     * @return static
     */
    public function sortKeysDesc($options = SORT_REGULAR);

    /**
<<<<<<< HEAD
     * Sort the collection keys using a callback.
     *
     * @param  callable(TKey, TKey): int  $callback
     * @return static
     */
    public function sortKeysUsing(callable $callback);

    /**
     * Get the sum of the given values.
     *
     * @param  (callable(TValue): mixed)|string|null  $callback
=======
     * Get the sum of the given values.
     *
     * @param  callable|string|null  $callback
>>>>>>> origin/New-FakeMain
     * @return mixed
     */
    public function sum($callback = null);

    /**
     * Take the first or last {$limit} items.
     *
     * @param  int  $limit
     * @return static
     */
    public function take($limit);

    /**
     * Take items in the collection until the given condition is met.
     *
<<<<<<< HEAD
     * @param  TValue|callable(TValue,TKey): bool  $value
=======
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function takeUntil($value);

    /**
     * Take items in the collection while the given condition is met.
     *
<<<<<<< HEAD
     * @param  TValue|callable(TValue,TKey): bool  $value
=======
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function takeWhile($value);

    /**
     * Pass the collection to the given callback and then return it.
     *
<<<<<<< HEAD
     * @param  callable(TValue): mixed  $callback
=======
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function tap(callable $callback);

    /**
     * Pass the enumerable to the given callback and return the result.
     *
<<<<<<< HEAD
     * @template TPipeReturnType
     *
     * @param  callable($this): TPipeReturnType  $callback
     * @return TPipeReturnType
=======
     * @param  callable  $callback
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function pipe(callable $callback);

    /**
<<<<<<< HEAD
     * Pass the collection into a new class.
     *
     * @param  class-string  $class
     * @return mixed
     */
    public function pipeInto($class);

    /**
     * Pass the collection through a series of callable pipes and return the result.
     *
     * @param  array<callable>  $pipes
     * @return mixed
     */
    public function pipeThrough($pipes);

    /**
     * Get the values of a given key.
     *
     * @param  string|array<array-key, string>  $value
     * @param  string|null  $key
     * @return static<int, mixed>
=======
     * Get the values of a given key.
     *
     * @param  string|array  $value
     * @param  string|null  $key
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function pluck($value, $key = null);

    /**
     * Create a collection of all elements that do not pass a given truth test.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|bool  $callback
=======
     * @param  callable|mixed  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function reject($callback = true);

    /**
<<<<<<< HEAD
     * Convert a flatten "dot" notation array into an expanded array.
     *
     * @return static
     */
    public function undot();

    /**
     * Return only unique items from the collection array.
     *
     * @param  (callable(TValue, TKey): mixed)|string|null  $key
=======
     * Return only unique items from the collection array.
     *
     * @param  string|callable|null  $key
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function unique($key = null, $strict = false);

    /**
     * Return only unique items from the collection array using strict comparison.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): mixed)|string|null  $key
=======
     * @param  string|callable|null  $key
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function uniqueStrict($key = null);

    /**
     * Reset the keys on the underlying array.
     *
<<<<<<< HEAD
     * @return static<int, TValue>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function values();

    /**
     * Pad collection to the specified length with a value.
     *
<<<<<<< HEAD
     * @template TPadValue
     *
     * @param  int  $size
     * @param  TPadValue  $value
     * @return static<int, TValue|TPadValue>
=======
     * @param  int  $size
     * @param  mixed  $value
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function pad($size, $value);

    /**
<<<<<<< HEAD
     * Get the values iterator.
     *
     * @return \Traversable<TKey, TValue>
     */
    public function getIterator(): Traversable;

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
    public function count(): int;

    /**
     * Count the number of items in the collection by a field or using a callback.
     *
     * @param  (callable(TValue, TKey): mixed)|string|null  $countBy
     * @return static<array-key, int>
=======
     * Count the number of items in the collection using a given truth test.
     *
     * @param  callable|null  $callback
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function countBy($callback = null);

    /**
     * Zip the collection together with one or more arrays.
     *
     * e.g. new Collection([1, 2, 3])->zip([4, 5, 6]);
     *      => [[1, 4], [2, 5], [3, 6]]
     *
<<<<<<< HEAD
     * @template TZipValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<array-key, TZipValue>|iterable<array-key, TZipValue>  ...$items
     * @return static<int, static<int, TValue|TZipValue>>
=======
     * @param  mixed  ...$items
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function zip($items);

    /**
     * Collect the values into a collection.
     *
<<<<<<< HEAD
     * @return \Illuminate\Support\Collection<TKey, TValue>
=======
     * @return \Illuminate\Support\Collection
>>>>>>> origin/New-FakeMain
     */
    public function collect();

    /**
<<<<<<< HEAD
     * Get the collection of items as a plain array.
     *
     * @return array<TKey, mixed>
     */
    public function toArray();

    /**
     * Convert the object into something JSON serializable.
     *
     * @return array<TKey, mixed>
     */
    public function jsonSerialize(): array;

    /**
     * Get the collection of items as JSON.
     *
     * @param  int  $options
     * @return string
     */
    public function toJson($options = 0);

    /**
     * Get a CachingIterator instance.
     *
     * @param  int  $flags
     * @return \CachingIterator
     */
    public function getCachingIterator($flags = CachingIterator::CALL_TOSTRING);

    /**
=======
>>>>>>> origin/New-FakeMain
     * Convert the collection to its string representation.
     *
     * @return string
     */
    public function __toString();

    /**
<<<<<<< HEAD
     * Indicate that the model's string representation should be escaped when __toString is invoked.
     *
     * @param  bool  $escape
     * @return $this
     */
    public function escapeWhenCastingToString($escape = true);

    /**
=======
>>>>>>> origin/New-FakeMain
     * Add a method to the list of proxied methods.
     *
     * @param  string  $method
     * @return void
     */
    public static function proxy($method);

    /**
     * Dynamically access collection proxies.
     *
     * @param  string  $key
     * @return mixed
     *
     * @throws \Exception
     */
    public function __get($key);
}
