<?php

namespace Illuminate\Console\Scheduling;

use Illuminate\Contracts\Container\Container;
use Illuminate\Support\Reflector;
use InvalidArgumentException;
use LogicException;
<<<<<<< HEAD
use RuntimeException;
=======
>>>>>>> origin/New-FakeMain
use Throwable;

class CallbackEvent extends Event
{
    /**
     * The callback to call.
     *
     * @var string
     */
    protected $callback;

    /**
     * The parameters to pass to the method.
     *
     * @var array
     */
    protected $parameters;

    /**
<<<<<<< HEAD
     * The result of the callback's execution.
     *
     * @var mixed
     */
    protected $result;

    /**
     * The exception that was thrown when calling the callback, if any.
     *
     * @var \Throwable|null
     */
    protected $exception;

    /**
     * Create a new event instance.
     *
     * @param  \Illuminate\Console\Scheduling\EventMutex  $mutex
     * @param  string|callable  $callback
=======
     * Create a new event instance.
     *
     * @param  \Illuminate\Console\Scheduling\EventMutex  $mutex
     * @param  string  $callback
>>>>>>> origin/New-FakeMain
     * @param  array  $parameters
     * @param  \DateTimeZone|string|null  $timezone
     * @return void
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(EventMutex $mutex, $callback, array $parameters = [], $timezone = null)
    {
        if (! is_string($callback) && ! Reflector::isCallable($callback)) {
            throw new InvalidArgumentException(
                'Invalid scheduled callback event. Must be a string or callable.'
            );
        }

        $this->mutex = $mutex;
        $this->callback = $callback;
        $this->parameters = $parameters;
        $this->timezone = $timezone;
    }

    /**
<<<<<<< HEAD
     * Run the callback event.
=======
     * Run the given event.
>>>>>>> origin/New-FakeMain
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return mixed
     *
<<<<<<< HEAD
     * @throws \Throwable
     */
    public function run(Container $container)
    {
        parent::run($container);

        if ($this->exception) {
            throw $this->exception;
        }

        return $this->result;
    }

    /**
     * Determine if the event should skip because another process is overlapping.
     *
     * @return bool
     */
    public function shouldSkipDueToOverlapping()
    {
        return $this->description && parent::shouldSkipDueToOverlapping();
    }

    /**
     * Indicate that the callback should run in the background.
     *
     * @return void
     *
     * @throws \RuntimeException
     */
    public function runInBackground()
    {
        throw new RuntimeException('Scheduled closures can not be run in the background.');
    }

    /**
     * Run the callback.
     *
     * @param  \Illuminate\Contracts\Container\Container  $container
     * @return int
     */
    protected function execute($container)
    {
        try {
            $this->result = is_object($this->callback)
                ? $container->call([$this->callback, '__invoke'], $this->parameters)
                : $container->call($this->callback, $this->parameters);

            return $this->result === false ? 1 : 0;
        } catch (Throwable $e) {
            $this->exception = $e;

            return 1;
=======
     * @throws \Exception
     */
    public function run(Container $container)
    {
        if ($this->description && $this->withoutOverlapping &&
            ! $this->mutex->create($this)) {
            return;
        }

        $pid = getmypid();

        register_shutdown_function(function () use ($pid) {
            if ($pid === getmypid()) {
                $this->removeMutex();
            }
        });

        parent::callBeforeCallbacks($container);

        try {
            $response = is_object($this->callback)
                        ? $container->call([$this->callback, '__invoke'], $this->parameters)
                        : $container->call($this->callback, $this->parameters);

            $this->exitCode = $response === false ? 1 : 0;
        } catch (Throwable $e) {
            $this->exitCode = 1;

            throw $e;
        } finally {
            $this->removeMutex();

            parent::callAfterCallbacks($container);
        }

        return $response;
    }

    /**
     * Clear the mutex for the event.
     *
     * @return void
     */
    protected function removeMutex()
    {
        if ($this->description && $this->withoutOverlapping) {
            $this->mutex->forget($this);
>>>>>>> origin/New-FakeMain
        }
    }

    /**
     * Do not allow the event to overlap each other.
     *
     * @param  int  $expiresAt
     * @return $this
     *
     * @throws \LogicException
     */
    public function withoutOverlapping($expiresAt = 1440)
    {
        if (! isset($this->description)) {
            throw new LogicException(
                "A scheduled event name is required to prevent overlapping. Use the 'name' method before 'withoutOverlapping'."
            );
        }

<<<<<<< HEAD
        return parent::withoutOverlapping($expiresAt);
=======
        $this->withoutOverlapping = true;

        $this->expiresAt = $expiresAt;

        return $this->skip(function () {
            return $this->mutex->exists($this);
        });
>>>>>>> origin/New-FakeMain
    }

    /**
     * Allow the event to only run on one server for each cron expression.
     *
     * @return $this
     *
     * @throws \LogicException
     */
    public function onOneServer()
    {
        if (! isset($this->description)) {
            throw new LogicException(
                "A scheduled event name is required to only run on one server. Use the 'name' method before 'onOneServer'."
            );
        }

<<<<<<< HEAD
        return parent::onOneServer();
=======
        $this->onOneServer = true;

        return $this;
    }

    /**
     * Get the mutex name for the scheduled command.
     *
     * @return string
     */
    public function mutexName()
    {
        return 'framework/schedule-'.sha1($this->description);
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the summary of the event for display.
     *
     * @return string
     */
    public function getSummaryForDisplay()
    {
        if (is_string($this->description)) {
            return $this->description;
        }

        return is_string($this->callback) ? $this->callback : 'Callback';
    }
<<<<<<< HEAD

    /**
     * Get the mutex name for the scheduled command.
     *
     * @return string
     */
    public function mutexName()
    {
        return 'framework/schedule-'.sha1($this->description);
    }

    /**
     * Clear the mutex for the event.
     *
     * @return void
     */
    protected function removeMutex()
    {
        if ($this->description) {
            parent::removeMutex();
        }
    }
=======
>>>>>>> origin/New-FakeMain
}
