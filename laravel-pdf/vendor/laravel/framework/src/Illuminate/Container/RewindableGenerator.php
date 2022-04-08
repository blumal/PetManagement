<?php

namespace Illuminate\Container;

use Countable;
use IteratorAggregate;
<<<<<<< HEAD
use Traversable;
=======
>>>>>>> origin/New-FakeMain

class RewindableGenerator implements Countable, IteratorAggregate
{
    /**
     * The generator callback.
     *
     * @var callable
     */
    protected $generator;

    /**
     * The number of tagged services.
     *
     * @var callable|int
     */
    protected $count;

    /**
     * Create a new generator instance.
     *
     * @param  callable  $generator
     * @param  callable|int  $count
     * @return void
     */
    public function __construct(callable $generator, $count)
    {
        $this->count = $count;
        $this->generator = $generator;
    }

    /**
     * Get an iterator from the generator.
     *
<<<<<<< HEAD
     * @return \Traversable
     */
    public function getIterator(): Traversable
=======
     * @return mixed
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
>>>>>>> origin/New-FakeMain
    {
        return ($this->generator)();
    }

    /**
     * Get the total number of tagged services.
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
        if (is_callable($count = $this->count)) {
            $this->count = $count();
        }

        return $this->count;
    }
}
