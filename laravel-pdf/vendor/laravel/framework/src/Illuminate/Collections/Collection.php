<?php

namespace Illuminate\Support;

use ArrayAccess;
use ArrayIterator;
use Illuminate\Contracts\Support\CanBeEscapedWhenCastToString;
use Illuminate\Support\Traits\EnumeratesValues;
use Illuminate\Support\Traits\Macroable;
use stdClass;
<<<<<<< HEAD
use Traversable;

/**
 * @template TKey of array-key
 * @template TValue
 *
 * @implements \ArrayAccess<TKey, TValue>
 * @implements \Illuminate\Support\Enumerable<TKey, TValue>
 */
class Collection implements ArrayAccess, CanBeEscapedWhenCastToString, Enumerable
{
    /**
     * @use \Illuminate\Support\Traits\EnumeratesValues<TKey, TValue>
     */
=======

class Collection implements ArrayAccess, CanBeEscapedWhenCastToString, Enumerable
{
>>>>>>> origin/New-FakeMain
    use EnumeratesValues, Macroable;

    /**
     * The items contained in the collection.
     *
<<<<<<< HEAD
     * @var array<TKey, TValue>
=======
     * @var array
>>>>>>> origin/New-FakeMain
     */
    protected $items = [];

    /**
     * Create a new collection.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>|null  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return void
     */
    public function __construct($items = [])
    {
        $this->items = $this->getArrayableItems($items);
    }

    /**
     * Create a collection with the given range.
     *
     * @param  int  $from
     * @param  int  $to
<<<<<<< HEAD
     * @return static<int, int>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public static function range($from, $to)
    {
        return new static(range($from, $to));
    }

    /**
     * Get all of the items in the collection.
     *
<<<<<<< HEAD
     * @return array<TKey, TValue>
=======
     * @return array
>>>>>>> origin/New-FakeMain
     */
    public function all()
    {
        return $this->items;
    }

    /**
     * Get a lazy collection for the items in this collection.
     *
<<<<<<< HEAD
     * @return \Illuminate\Support\LazyCollection<TKey, TValue>
=======
     * @return \Illuminate\Support\LazyCollection
>>>>>>> origin/New-FakeMain
     */
    public function lazy()
    {
        return new LazyCollection($this->items);
    }

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
    public function avg($callback = null)
    {
        $callback = $this->valueRetriever($callback);

        $items = $this->map(function ($value) use ($callback) {
            return $callback($value);
        })->filter(function ($value) {
            return ! is_null($value);
        });

        if ($count = $items->count()) {
            return $items->sum() / $count;
        }
    }

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
    public function median($key = null)
    {
        $values = (isset($key) ? $this->pluck($key) : $this)
            ->filter(function ($item) {
                return ! is_null($item);
            })->sort()->values();

        $count = $values->count();

        if ($count === 0) {
            return;
        }

        $middle = (int) ($count / 2);

        if ($count % 2) {
            return $values->get($middle);
        }

        return (new static([
            $values->get($middle - 1), $values->get($middle),
        ]))->average();
    }

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
    public function mode($key = null)
    {
        if ($this->count() === 0) {
            return;
        }

        $collection = isset($key) ? $this->pluck($key) : $this;

        $counts = new static;

        $collection->each(function ($value) use ($counts) {
            $counts[$value] = isset($counts[$value]) ? $counts[$value] + 1 : 1;
        });

        $sorted = $counts->sort();

        $highestValue = $sorted->last();

        return $sorted->filter(function ($value) use ($highestValue) {
            return $value == $highestValue;
        })->sort()->keys()->all();
    }

    /**
     * Collapse the collection of items into a single array.
     *
<<<<<<< HEAD
     * @return static<int, mixed>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function collapse()
    {
        return new static(Arr::collapse($this->items));
    }

    /**
     * Determine if an item exists in the collection.
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
    public function contains($key, $operator = null, $value = null)
    {
        if (func_num_args() === 1) {
            if ($this->useAsCallable($key)) {
                $placeholder = new stdClass;

                return $this->first($key, $placeholder) !== $placeholder;
            }

            return in_array($key, $this->items);
        }

        return $this->contains($this->operatorForWhere(...func_get_args()));
    }

    /**
     * Determine if an item is not contained in the collection.
     *
     * @param  mixed  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return bool
     */
    public function doesntContain($key, $operator = null, $value = null)
    {
        return ! $this->contains(...func_get_args());
    }

    /**
     * Cross join with the given lists, returning all possible permutations.
     *
<<<<<<< HEAD
     * @template TCrossJoinKey
     * @template TCrossJoinValue
     *
     * @param  \Illuminate\Contracts\Support\Arrayable<TCrossJoinKey, TCrossJoinValue>|iterable<TCrossJoinKey, TCrossJoinValue>  ...$lists
     * @return static<int, array<int, TValue|TCrossJoinValue>>
=======
     * @param  mixed  ...$lists
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function crossJoin(...$lists)
    {
        return new static(Arr::crossJoin(
            $this->items, ...array_map([$this, 'getArrayableItems'], $lists)
        ));
    }

    /**
     * Get the items in the collection that are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<array-key, TValue>|iterable<array-key, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diff($items)
    {
        return new static(array_diff($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Get the items in the collection that are not present in the given items, using the callback.
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
    public function diffUsing($items, callable $callback)
    {
        return new static(array_udiff($this->items, $this->getArrayableItems($items), $callback));
    }

    /**
     * Get the items in the collection whose keys and values are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffAssoc($items)
    {
        return new static(array_diff_assoc($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Get the items in the collection whose keys and values are not present in the given items, using the callback.
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
    public function diffAssocUsing($items, callable $callback)
    {
        return new static(array_diff_uassoc($this->items, $this->getArrayableItems($items), $callback));
    }

    /**
     * Get the items in the collection whose keys are not present in the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function diffKeys($items)
    {
        return new static(array_diff_key($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Get the items in the collection whose keys are not present in the given items, using the callback.
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
    public function diffKeysUsing($items, callable $callback)
    {
        return new static(array_diff_ukey($this->items, $this->getArrayableItems($items), $callback));
    }

    /**
     * Retrieve duplicate items from the collection.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|string|null  $callback
=======
     * @param  callable|string|null  $callback
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function duplicates($callback = null, $strict = false)
    {
        $items = $this->map($this->valueRetriever($callback));

        $uniqueItems = $items->unique(null, $strict);

        $compare = $this->duplicateComparator($strict);

        $duplicates = new static;

        foreach ($items as $key => $value) {
            if ($uniqueItems->isNotEmpty() && $compare($value, $uniqueItems->first())) {
                $uniqueItems->shift();
            } else {
                $duplicates[$key] = $value;
            }
        }

        return $duplicates;
    }

    /**
     * Retrieve duplicate items from the collection using strict comparison.
     *
<<<<<<< HEAD
     * @param  (callable(TValue): bool)|string|null  $callback
=======
     * @param  callable|string|null  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function duplicatesStrict($callback = null)
    {
        return $this->duplicates($callback, true);
    }

    /**
     * Get the comparison function to detect duplicates.
     *
     * @param  bool  $strict
<<<<<<< HEAD
     * @return callable(TValue, TValue): bool
=======
     * @return \Closure
>>>>>>> origin/New-FakeMain
     */
    protected function duplicateComparator($strict)
    {
        if ($strict) {
            return function ($a, $b) {
                return $a === $b;
            };
        }

        return function ($a, $b) {
            return $a == $b;
        };
    }

    /**
     * Get all items except for those with the specified keys.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Support\Enumerable<array-key, TKey>|array<array-key, TKey>  $keys
=======
     * @param  \Illuminate\Support\Collection|mixed  $keys
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function except($keys)
    {
        if ($keys instanceof Enumerable) {
            $keys = $keys->all();
        } elseif (! is_array($keys)) {
            $keys = func_get_args();
        }

        return new static(Arr::except($this->items, $keys));
    }

    /**
     * Run a filter over each of the items.
     *
<<<<<<< HEAD
     * @param (callable(TValue, TKey): bool)|null  $callback
=======
     * @param  callable|null  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function filter(callable $callback = null)
    {
        if ($callback) {
            return new static(Arr::where($this->items, $callback));
        }

        return new static(array_filter($this->items));
    }

    /**
     * Get the first item from the collection passing the given truth test.
     *
<<<<<<< HEAD
     * @template TFirstDefault
     *
     * @param  (callable(TValue, TKey): bool)|null  $callback
     * @param  TFirstDefault|(\Closure(): TFirstDefault)  $default
     * @return TValue|TFirstDefault
=======
     * @param  callable|null  $callback
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function first(callable $callback = null, $default = null)
    {
        return Arr::first($this->items, $callback, $default);
    }

    /**
     * Get a flattened array of the items in the collection.
     *
     * @param  int  $depth
<<<<<<< HEAD
     * @return static<int, mixed>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function flatten($depth = INF)
    {
        return new static(Arr::flatten($this->items, $depth));
    }

    /**
     * Flip the items in the collection.
     *
<<<<<<< HEAD
     * @return static<TValue, TKey>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function flip()
    {
        return new static(array_flip($this->items));
    }

    /**
     * Remove an item from the collection by key.
     *
<<<<<<< HEAD
     * @param  TKey|array<array-key, TKey>  $keys
=======
     * @param  string|int|array  $keys
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function forget($keys)
    {
        foreach ((array) $keys as $key) {
            $this->offsetUnset($key);
        }

        return $this;
    }

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
    public function get($key, $default = null)
    {
        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        }

        return value($default);
    }

    /**
     * Get an item from the collection by key or add it to collection if it does not exist.
     *
     * @param  mixed  $key
     * @param  mixed  $value
     * @return mixed
     */
    public function getOrPut($key, $value)
    {
        if (array_key_exists($key, $this->items)) {
            return $this->items[$key];
        }

        $this->offsetSet($key, $value = value($value));

        return $value;
    }

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
    public function groupBy($groupBy, $preserveKeys = false)
    {
        if (! $this->useAsCallable($groupBy) && is_array($groupBy)) {
            $nextGroups = $groupBy;

            $groupBy = array_shift($nextGroups);
        }

        $groupBy = $this->valueRetriever($groupBy);

        $results = [];

        foreach ($this->items as $key => $value) {
            $groupKeys = $groupBy($value, $key);

            if (! is_array($groupKeys)) {
                $groupKeys = [$groupKeys];
            }

            foreach ($groupKeys as $groupKey) {
<<<<<<< HEAD
                $groupKey = match (true) {
                    is_bool($groupKey) => (int) $groupKey,
                    $groupKey instanceof \Stringable => (string) $groupKey,
                    default => $groupKey,
                };
=======
                $groupKey = is_bool($groupKey) ? (int) $groupKey : $groupKey;
>>>>>>> origin/New-FakeMain

                if (! array_key_exists($groupKey, $results)) {
                    $results[$groupKey] = new static;
                }

                $results[$groupKey]->offsetSet($preserveKeys ? $key : null, $value);
            }
        }

        $result = new static($results);

        if (! empty($nextGroups)) {
            return $result->map->groupBy($nextGroups, $preserveKeys);
        }

        return $result;
    }

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
    public function keyBy($keyBy)
    {
        $keyBy = $this->valueRetriever($keyBy);

        $results = [];

        foreach ($this->items as $key => $item) {
            $resolvedKey = $keyBy($item, $key);

            if (is_object($resolvedKey)) {
                $resolvedKey = (string) $resolvedKey;
            }

            $results[$resolvedKey] = $item;
        }

        return new static($results);
    }

    /**
     * Determine if an item exists in the collection by key.
     *
<<<<<<< HEAD
     * @param  TKey|array<array-key, TKey>  $key
=======
     * @param  mixed  $key
>>>>>>> origin/New-FakeMain
     * @return bool
     */
    public function has($key)
    {
        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if (! array_key_exists($value, $this->items)) {
                return false;
            }
        }

        return true;
    }

    /**
     * Determine if any of the keys exist in the collection.
     *
     * @param  mixed  $key
     * @return bool
     */
    public function hasAny($key)
    {
        if ($this->isEmpty()) {
            return false;
        }

        $keys = is_array($key) ? $key : func_get_args();

        foreach ($keys as $value) {
            if ($this->has($value)) {
                return true;
            }
        }

        return false;
    }

    /**
     * Concatenate values of a given key as a string.
     *
<<<<<<< HEAD
     * @param  callable|string  $value
=======
     * @param  string  $value
>>>>>>> origin/New-FakeMain
     * @param  string|null  $glue
     * @return string
     */
    public function implode($value, $glue = null)
    {
<<<<<<< HEAD
        if ($this->useAsCallable($value)) {
            return implode($glue ?? '', $this->map($value)->all());
        }

=======
>>>>>>> origin/New-FakeMain
        $first = $this->first();

        if (is_array($first) || (is_object($first) && ! $first instanceof Stringable)) {
            return implode($glue ?? '', $this->pluck($value)->all());
        }

        return implode($value ?? '', $this->items);
    }

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
    public function intersect($items)
    {
        return new static(array_intersect($this->items, $this->getArrayableItems($items)));
    }

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
    public function intersectByKeys($items)
    {
        return new static(array_intersect_key(
            $this->items, $this->getArrayableItems($items)
        ));
    }

    /**
     * Determine if the collection is empty or not.
     *
     * @return bool
     */
    public function isEmpty()
    {
        return empty($this->items);
    }

    /**
     * Determine if the collection contains a single item.
     *
     * @return bool
     */
    public function containsOneItem()
    {
        return $this->count() === 1;
    }

    /**
     * Join all items from the collection using a string. The final items can use a separate glue string.
     *
     * @param  string  $glue
     * @param  string  $finalGlue
     * @return string
     */
    public function join($glue, $finalGlue = '')
    {
        if ($finalGlue === '') {
            return $this->implode($glue);
        }

        $count = $this->count();

        if ($count === 0) {
            return '';
        }

        if ($count === 1) {
            return $this->last();
        }

        $collection = new static($this->items);

        $finalItem = $collection->pop();

        return $collection->implode($glue).$finalGlue.$finalItem;
    }

    /**
     * Get the keys of the collection items.
     *
<<<<<<< HEAD
     * @return static<int, TKey>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function keys()
    {
        return new static(array_keys($this->items));
    }

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
    public function last(callable $callback = null, $default = null)
    {
        return Arr::last($this->items, $callback, $default);
    }

    /**
     * Get the values of a given key.
     *
<<<<<<< HEAD
     * @param  string|int|array<array-key, string>  $value
     * @param  string|null  $key
     * @return static<int, mixed>
=======
     * @param  string|array|int|null  $value
     * @param  string|null  $key
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function pluck($value, $key = null)
    {
        return new static(Arr::pluck($this->items, $value, $key));
    }

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
    public function map(callable $callback)
    {
        $keys = array_keys($this->items);

        $items = array_map($callback, $this->items, $keys);

        return new static(array_combine($keys, $items));
    }

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
    public function mapToDictionary(callable $callback)
    {
        $dictionary = [];

        foreach ($this->items as $key => $item) {
            $pair = $callback($item, $key);

            $key = key($pair);

            $value = reset($pair);

            if (! isset($dictionary[$key])) {
                $dictionary[$key] = [];
            }

            $dictionary[$key][] = $value;
        }

        return new static($dictionary);
    }

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
    public function mapWithKeys(callable $callback)
    {
        $result = [];

        foreach ($this->items as $key => $value) {
            $assoc = $callback($value, $key);

            foreach ($assoc as $mapKey => $mapValue) {
                $result[$mapKey] = $mapValue;
            }
        }

        return new static($result);
    }

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
    public function merge($items)
    {
        return new static(array_merge($this->items, $this->getArrayableItems($items)));
    }

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
    public function mergeRecursive($items)
    {
        return new static(array_merge_recursive($this->items, $this->getArrayableItems($items)));
    }

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
    public function combine($values)
    {
        return new static(array_combine($this->all(), $this->getArrayableItems($values)));
    }

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
    public function union($items)
    {
        return new static($this->items + $this->getArrayableItems($items));
    }

    /**
     * Create a new collection consisting of every n-th element.
     *
     * @param  int  $step
     * @param  int  $offset
     * @return static
     */
    public function nth($step, $offset = 0)
    {
        $new = [];

        $position = 0;

        foreach ($this->slice($offset)->items as $item) {
            if ($position % $step === 0) {
                $new[] = $item;
            }

            $position++;
        }

        return new static($new);
    }

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
    public function only($keys)
    {
        if (is_null($keys)) {
            return new static($this->items);
        }

        if ($keys instanceof Enumerable) {
            $keys = $keys->all();
        }

        $keys = is_array($keys) ? $keys : func_get_args();

        return new static(Arr::only($this->items, $keys));
    }

    /**
     * Get and remove the last N items from the collection.
     *
     * @param  int  $count
<<<<<<< HEAD
     * @return static<int, TValue>|TValue|null
=======
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function pop($count = 1)
    {
        if ($count === 1) {
            return array_pop($this->items);
        }

        if ($this->isEmpty()) {
            return new static;
        }

        $results = [];

        $collectionCount = $this->count();

        foreach (range(1, min($count, $collectionCount)) as $item) {
            array_push($results, array_pop($this->items));
        }

        return new static($results);
    }

    /**
     * Push an item onto the beginning of the collection.
     *
<<<<<<< HEAD
     * @param  TValue  $value
     * @param  TKey  $key
=======
     * @param  mixed  $value
     * @param  mixed  $key
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function prepend($value, $key = null)
    {
        $this->items = Arr::prepend($this->items, ...func_get_args());

        return $this;
    }

    /**
     * Push one or more items onto the end of the collection.
     *
<<<<<<< HEAD
     * @param  TValue  ...$values
=======
     * @param  mixed  $values
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function push(...$values)
    {
        foreach ($values as $value) {
            $this->items[] = $value;
        }

        return $this;
    }

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
    public function concat($source)
    {
        $result = new static($this);

        foreach ($source as $item) {
            $result->push($item);
        }

        return $result;
    }

    /**
     * Get and remove an item from the collection.
     *
<<<<<<< HEAD
     * @template TPullDefault
     *
     * @param  TKey  $key
     * @param  TPullDefault|(\Closure(): TPullDefault)  $default
     * @return TValue|TPullDefault
=======
     * @param  mixed  $key
     * @param  mixed  $default
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function pull($key, $default = null)
    {
        return Arr::pull($this->items, $key, $default);
    }

    /**
     * Put an item in the collection by key.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @param  TValue  $value
=======
     * @param  mixed  $key
     * @param  mixed  $value
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function put($key, $value)
    {
        $this->offsetSet($key, $value);

        return $this;
    }

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
    public function random($number = null)
    {
        if (is_null($number)) {
            return Arr::random($this->items);
        }

        return new static(Arr::random($this->items, $number));
    }

    /**
     * Replace the collection items with the given items.
     *
<<<<<<< HEAD
     * @param  \Illuminate\Contracts\Support\Arrayable<TKey, TValue>|iterable<TKey, TValue>  $items
=======
     * @param  mixed  $items
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function replace($items)
    {
        return new static(array_replace($this->items, $this->getArrayableItems($items)));
    }

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
    public function replaceRecursive($items)
    {
        return new static(array_replace_recursive($this->items, $this->getArrayableItems($items)));
    }

    /**
     * Reverse items order.
     *
     * @return static
     */
    public function reverse()
    {
        return new static(array_reverse($this->items, true));
    }

    /**
     * Search the collection for a given value and return the corresponding key if successful.
     *
<<<<<<< HEAD
     * @param  TValue|(callable(TValue,TKey): bool)  $value
     * @param  bool  $strict
     * @return TKey|bool
=======
     * @param  mixed  $value
     * @param  bool  $strict
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function search($value, $strict = false)
    {
        if (! $this->useAsCallable($value)) {
            return array_search($value, $this->items, $strict);
        }

        foreach ($this->items as $key => $item) {
            if ($value($item, $key)) {
                return $key;
            }
        }

        return false;
    }

    /**
     * Get and remove the first N items from the collection.
     *
     * @param  int  $count
<<<<<<< HEAD
     * @return static<int, TValue>|TValue|null
=======
     * @return mixed
>>>>>>> origin/New-FakeMain
     */
    public function shift($count = 1)
    {
        if ($count === 1) {
            return array_shift($this->items);
        }

        if ($this->isEmpty()) {
            return new static;
        }

        $results = [];

        $collectionCount = $this->count();

        foreach (range(1, min($count, $collectionCount)) as $item) {
            array_push($results, array_shift($this->items));
        }

        return new static($results);
    }

    /**
     * Shuffle the items in the collection.
     *
     * @param  int|null  $seed
     * @return static
     */
    public function shuffle($seed = null)
    {
        return new static(Arr::shuffle($this->items, $seed));
    }

    /**
     * Create chunks representing a "sliding window" view of the items in the collection.
     *
     * @param  int  $size
     * @param  int  $step
<<<<<<< HEAD
     * @return static<int, static>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function sliding($size = 2, $step = 1)
    {
        $chunks = floor(($this->count() - $size) / $step) + 1;

        return static::times($chunks, function ($number) use ($size, $step) {
            return $this->slice(($number - 1) * $step, $size);
        });
    }

    /**
     * Skip the first {$count} items.
     *
     * @param  int  $count
     * @return static
     */
    public function skip($count)
    {
        return $this->slice($count);
    }

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
    public function skipUntil($value)
    {
        return new static($this->lazy()->skipUntil($value)->all());
    }

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
    public function skipWhile($value)
    {
        return new static($this->lazy()->skipWhile($value)->all());
    }

    /**
     * Slice the underlying collection array.
     *
     * @param  int  $offset
     * @param  int|null  $length
     * @return static
     */
    public function slice($offset, $length = null)
    {
        return new static(array_slice($this->items, $offset, $length, true));
    }

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
    public function split($numberOfGroups)
    {
        if ($this->isEmpty()) {
            return new static;
        }

        $groups = new static;

        $groupSize = floor($this->count() / $numberOfGroups);

        $remain = $this->count() % $numberOfGroups;

        $start = 0;

        for ($i = 0; $i < $numberOfGroups; $i++) {
            $size = $groupSize;

            if ($i < $remain) {
                $size++;
            }

            if ($size) {
                $groups->push(new static(array_slice($this->items, $start, $size)));

                $start += $size;
            }
        }

        return $groups;
    }

    /**
     * Split a collection into a certain number of groups, and fill the first groups completely.
     *
     * @param  int  $numberOfGroups
<<<<<<< HEAD
     * @return static<int, static>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function splitIn($numberOfGroups)
    {
        return $this->chunk(ceil($this->count() / $numberOfGroups));
    }

    /**
     * Get the first item in the collection, but only if exactly one item exists. Otherwise, throw an exception.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return TValue
=======
     * @param  mixed  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return mixed
>>>>>>> origin/New-FakeMain
     *
     * @throws \Illuminate\Support\ItemNotFoundException
     * @throws \Illuminate\Support\MultipleItemsFoundException
     */
    public function sole($key = null, $operator = null, $value = null)
    {
        $filter = func_num_args() > 1
            ? $this->operatorForWhere(...func_get_args())
            : $key;

<<<<<<< HEAD
        $items = $this->unless($filter == null)->filter($filter);

        $count = $items->count();

        if ($count === 0) {
            throw new ItemNotFoundException;
        }

        if ($count > 1) {
            throw new MultipleItemsFoundException($count);
=======
        $items = $this->when($filter)->filter($filter);

        if ($items->isEmpty()) {
            throw new ItemNotFoundException;
        }

        if ($items->count() > 1) {
            throw new MultipleItemsFoundException;
>>>>>>> origin/New-FakeMain
        }

        return $items->first();
    }

    /**
     * Get the first item in the collection but throw an exception if no matching items exist.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): bool)|string  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return TValue
=======
     * @param  mixed  $key
     * @param  mixed  $operator
     * @param  mixed  $value
     * @return mixed
>>>>>>> origin/New-FakeMain
     *
     * @throws \Illuminate\Support\ItemNotFoundException
     */
    public function firstOrFail($key = null, $operator = null, $value = null)
    {
        $filter = func_num_args() > 1
            ? $this->operatorForWhere(...func_get_args())
            : $key;

        $placeholder = new stdClass();

        $item = $this->first($filter, $placeholder);

        if ($item === $placeholder) {
            throw new ItemNotFoundException;
        }

        return $item;
    }

    /**
     * Chunk the collection into chunks of the given size.
     *
     * @param  int  $size
<<<<<<< HEAD
     * @return static<int, static>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function chunk($size)
    {
        if ($size <= 0) {
            return new static;
        }

        $chunks = [];

        foreach (array_chunk($this->items, $size, true) as $chunk) {
            $chunks[] = new static($chunk);
        }

        return new static($chunks);
    }

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
    public function chunkWhile(callable $callback)
    {
        return new static(
            $this->lazy()->chunkWhile($callback)->mapInto(static::class)
        );
    }

    /**
     * Sort through each item with a callback.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TValue): int)|null|int  $callback
=======
     * @param  callable|int|null  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function sort($callback = null)
    {
        $items = $this->items;

        $callback && is_callable($callback)
            ? uasort($items, $callback)
            : asort($items, $callback ?? SORT_REGULAR);

        return new static($items);
    }

    /**
     * Sort items in descending order.
     *
     * @param  int  $options
     * @return static
     */
    public function sortDesc($options = SORT_REGULAR)
    {
        $items = $this->items;

        arsort($items, $options);

        return new static($items);
    }

    /**
     * Sort the collection using the given callback.
     *
<<<<<<< HEAD
     * @param  array<array-key, (callable(TValue, TKey): mixed)|array<array-key, string>|(callable(TValue, TKey): mixed)|string  $callback
=======
     * @param  callable|array|string  $callback
>>>>>>> origin/New-FakeMain
     * @param  int  $options
     * @param  bool  $descending
     * @return static
     */
    public function sortBy($callback, $options = SORT_REGULAR, $descending = false)
    {
        if (is_array($callback) && ! is_callable($callback)) {
            return $this->sortByMany($callback);
        }

        $results = [];

        $callback = $this->valueRetriever($callback);

        // First we will loop through the items and get the comparator from a callback
        // function which we were given. Then, we will sort the returned values and
        // grab all the corresponding values for the sorted keys from this array.
        foreach ($this->items as $key => $value) {
            $results[$key] = $callback($value, $key);
        }

        $descending ? arsort($results, $options)
            : asort($results, $options);

        // Once we have sorted all of the keys in the array, we will loop through them
        // and grab the corresponding model so we can set the underlying items list
        // to the sorted version. Then we'll just return the collection instance.
        foreach (array_keys($results) as $key) {
            $results[$key] = $this->items[$key];
        }

        return new static($results);
    }

    /**
     * Sort the collection using multiple comparisons.
     *
<<<<<<< HEAD
     * @param  array<array-key, (callable(TValue, TKey): mixed)|array<array-key, string>  $comparisons
=======
     * @param  array  $comparisons
>>>>>>> origin/New-FakeMain
     * @return static
     */
    protected function sortByMany(array $comparisons = [])
    {
        $items = $this->items;

        usort($items, function ($a, $b) use ($comparisons) {
            foreach ($comparisons as $comparison) {
                $comparison = Arr::wrap($comparison);

                $prop = $comparison[0];

                $ascending = Arr::get($comparison, 1, true) === true ||
                             Arr::get($comparison, 1, true) === 'asc';

<<<<<<< HEAD
=======
                $result = 0;

>>>>>>> origin/New-FakeMain
                if (! is_string($prop) && is_callable($prop)) {
                    $result = $prop($a, $b);
                } else {
                    $values = [data_get($a, $prop), data_get($b, $prop)];

                    if (! $ascending) {
                        $values = array_reverse($values);
                    }

                    $result = $values[0] <=> $values[1];
                }

                if ($result === 0) {
                    continue;
                }

                return $result;
            }
        });

        return new static($items);
    }

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
    public function sortByDesc($callback, $options = SORT_REGULAR)
    {
        return $this->sortBy($callback, $options, true);
    }

    /**
     * Sort the collection keys.
     *
     * @param  int  $options
     * @param  bool  $descending
     * @return static
     */
    public function sortKeys($options = SORT_REGULAR, $descending = false)
    {
        $items = $this->items;

        $descending ? krsort($items, $options) : ksort($items, $options);

        return new static($items);
    }

    /**
     * Sort the collection keys in descending order.
     *
     * @param  int  $options
     * @return static
     */
    public function sortKeysDesc($options = SORT_REGULAR)
    {
        return $this->sortKeys($options, true);
    }

    /**
     * Sort the collection keys using a callback.
     *
<<<<<<< HEAD
     * @param  callable(TKey, TKey): int  $callback
=======
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function sortKeysUsing(callable $callback)
    {
        $items = $this->items;

        uksort($items, $callback);

        return new static($items);
    }

    /**
     * Splice a portion of the underlying collection array.
     *
     * @param  int  $offset
     * @param  int|null  $length
<<<<<<< HEAD
     * @param  array<array-key, TValue>  $replacement
=======
     * @param  mixed  $replacement
>>>>>>> origin/New-FakeMain
     * @return static
     */
    public function splice($offset, $length = null, $replacement = [])
    {
        if (func_num_args() === 1) {
            return new static(array_splice($this->items, $offset));
        }

        return new static(array_splice($this->items, $offset, $length, $this->getArrayableItems($replacement)));
    }

    /**
     * Take the first or last {$limit} items.
     *
     * @param  int  $limit
     * @return static
     */
    public function take($limit)
    {
        if ($limit < 0) {
            return $this->slice($limit, abs($limit));
        }

        return $this->slice(0, $limit);
    }

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
    public function takeUntil($value)
    {
        return new static($this->lazy()->takeUntil($value)->all());
    }

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
    public function takeWhile($value)
    {
        return new static($this->lazy()->takeWhile($value)->all());
    }

    /**
     * Transform each item in the collection using a callback.
     *
<<<<<<< HEAD
     * @param  callable(TValue, TKey): TValue  $callback
=======
     * @param  callable  $callback
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function transform(callable $callback)
    {
        $this->items = $this->map($callback)->all();

        return $this;
    }

    /**
     * Convert a flatten "dot" notation array into an expanded array.
     *
     * @return static
     */
    public function undot()
    {
        return new static(Arr::undot($this->all()));
    }

    /**
     * Return only unique items from the collection array.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): mixed)|string|null  $key
=======
     * @param  string|callable|null  $key
>>>>>>> origin/New-FakeMain
     * @param  bool  $strict
     * @return static
     */
    public function unique($key = null, $strict = false)
    {
        if (is_null($key) && $strict === false) {
            return new static(array_unique($this->items, SORT_REGULAR));
        }

        $callback = $this->valueRetriever($key);

        $exists = [];

        return $this->reject(function ($item, $key) use ($callback, $strict, &$exists) {
            if (in_array($id = $callback($item, $key), $exists, $strict)) {
                return true;
            }

            $exists[] = $id;
        });
    }

    /**
     * Reset the keys on the underlying array.
     *
<<<<<<< HEAD
     * @return static<int, TValue>
=======
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function values()
    {
        return new static(array_values($this->items));
    }

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
    public function zip($items)
    {
        $arrayableItems = array_map(function ($items) {
            return $this->getArrayableItems($items);
        }, func_get_args());

        $params = array_merge([function () {
            return new static(func_get_args());
        }, $this->items], $arrayableItems);

        return new static(array_map(...$params));
    }

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
    public function pad($size, $value)
    {
        return new static(array_pad($this->items, $size, $value));
    }

    /**
     * Get an iterator for the items.
     *
<<<<<<< HEAD
     * @return \ArrayIterator<TKey, TValue>
     */
    public function getIterator(): Traversable
=======
     * @return \ArrayIterator
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
>>>>>>> origin/New-FakeMain
    {
        return new ArrayIterator($this->items);
    }

    /**
     * Count the number of items in the collection.
     *
     * @return int
     */
<<<<<<< HEAD
    public function count(): int
=======
    #[\ReturnTypeWillChange]
    public function count()
>>>>>>> origin/New-FakeMain
    {
        return count($this->items);
    }

    /**
     * Count the number of items in the collection by a field or using a callback.
     *
<<<<<<< HEAD
     * @param  (callable(TValue, TKey): mixed)|string|null  $countBy
     * @return static<array-key, int>
=======
     * @param  callable|string  $countBy
     * @return static
>>>>>>> origin/New-FakeMain
     */
    public function countBy($countBy = null)
    {
        return new static($this->lazy()->countBy($countBy)->all());
    }

    /**
     * Add an item to the collection.
     *
<<<<<<< HEAD
     * @param  TValue  $item
=======
     * @param  mixed  $item
>>>>>>> origin/New-FakeMain
     * @return $this
     */
    public function add($item)
    {
        $this->items[] = $item;

        return $this;
    }

    /**
     * Get a base Support collection instance from this collection.
     *
<<<<<<< HEAD
     * @return \Illuminate\Support\Collection<TKey, TValue>
=======
     * @return \Illuminate\Support\Collection
>>>>>>> origin/New-FakeMain
     */
    public function toBase()
    {
        return new self($this);
    }

    /**
     * Determine if an item exists at an offset.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @return bool
     */
    public function offsetExists($key): bool
=======
     * @param  mixed  $key
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function offsetExists($key)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->items[$key]);
    }

    /**
     * Get an item at a given offset.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @return TValue
     */
    public function offsetGet($key): mixed
=======
     * @param  mixed  $key
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function offsetGet($key)
>>>>>>> origin/New-FakeMain
    {
        return $this->items[$key];
    }

    /**
     * Set the item at a given offset.
     *
<<<<<<< HEAD
     * @param  TKey|null  $key
     * @param  TValue  $value
     * @return void
     */
    public function offsetSet($key, $value): void
=======
     * @param  mixed  $key
     * @param  mixed  $value
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetSet($key, $value)
>>>>>>> origin/New-FakeMain
    {
        if (is_null($key)) {
            $this->items[] = $value;
        } else {
            $this->items[$key] = $value;
        }
    }

    /**
     * Unset the item at a given offset.
     *
<<<<<<< HEAD
     * @param  TKey  $key
     * @return void
     */
    public function offsetUnset($key): void
=======
     * @param  mixed  $key
     * @return void
     */
    #[\ReturnTypeWillChange]
    public function offsetUnset($key)
>>>>>>> origin/New-FakeMain
    {
        unset($this->items[$key]);
    }
}
