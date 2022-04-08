<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher\Debug;

use Psr\EventDispatcher\StoppableEventInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;
use Symfony\Component\Stopwatch\Stopwatch;
use Symfony\Component\VarDumper\Caster\ClassStub;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
final class WrappedListener
{
<<<<<<< HEAD
    private string|array|object $listener;
    private ?\Closure $optimizedListener;
    private string $name;
    private bool $called = false;
    private bool $stoppedPropagation = false;
    private $stopwatch;
    private $dispatcher;
    private string $pretty;
    private $stub;
    private ?int $priority = null;
    private static bool $hasClassStub;

    public function __construct(callable|array $listener, ?string $name, Stopwatch $stopwatch, EventDispatcherInterface $dispatcher = null)
=======
    private $listener;
    private $optimizedListener;
    private $name;
    private $called;
    private $stoppedPropagation;
    private $stopwatch;
    private $dispatcher;
    private $pretty;
    private $stub;
    private $priority;
    private static $hasClassStub;

    public function __construct($listener, ?string $name, Stopwatch $stopwatch, EventDispatcherInterface $dispatcher = null)
>>>>>>> origin/New-FakeMain
    {
        $this->listener = $listener;
        $this->optimizedListener = $listener instanceof \Closure ? $listener : (\is_callable($listener) ? \Closure::fromCallable($listener) : null);
        $this->stopwatch = $stopwatch;
        $this->dispatcher = $dispatcher;
<<<<<<< HEAD
=======
        $this->called = false;
        $this->stoppedPropagation = false;
>>>>>>> origin/New-FakeMain

        if (\is_array($listener)) {
            $this->name = \is_object($listener[0]) ? get_debug_type($listener[0]) : $listener[0];
            $this->pretty = $this->name.'::'.$listener[1];
        } elseif ($listener instanceof \Closure) {
            $r = new \ReflectionFunction($listener);
            if (str_contains($r->name, '{closure}')) {
                $this->pretty = $this->name = 'closure';
            } elseif ($class = $r->getClosureScopeClass()) {
                $this->name = $class->name;
                $this->pretty = $this->name.'::'.$r->name;
            } else {
                $this->pretty = $this->name = $r->name;
            }
        } elseif (\is_string($listener)) {
            $this->pretty = $this->name = $listener;
        } else {
            $this->name = get_debug_type($listener);
            $this->pretty = $this->name.'::__invoke';
        }

        if (null !== $name) {
            $this->name = $name;
        }

<<<<<<< HEAD
        self::$hasClassStub ??= class_exists(ClassStub::class);
    }

    public function getWrappedListener(): callable|array
=======
        if (null === self::$hasClassStub) {
            self::$hasClassStub = class_exists(ClassStub::class);
        }
    }

    public function getWrappedListener()
>>>>>>> origin/New-FakeMain
    {
        return $this->listener;
    }

    public function wasCalled(): bool
    {
        return $this->called;
    }

    public function stoppedPropagation(): bool
    {
        return $this->stoppedPropagation;
    }

    public function getPretty(): string
    {
        return $this->pretty;
    }

    public function getInfo(string $eventName): array
    {
<<<<<<< HEAD
        $this->stub ??= self::$hasClassStub ? new ClassStub($this->pretty.'()', $this->listener) : $this->pretty.'()';
=======
        if (null === $this->stub) {
            $this->stub = self::$hasClassStub ? new ClassStub($this->pretty.'()', $this->listener) : $this->pretty.'()';
        }
>>>>>>> origin/New-FakeMain

        return [
            'event' => $eventName,
            'priority' => null !== $this->priority ? $this->priority : (null !== $this->dispatcher ? $this->dispatcher->getListenerPriority($eventName, $this->listener) : null),
            'pretty' => $this->pretty,
            'stub' => $this->stub,
        ];
    }

    public function __invoke(object $event, string $eventName, EventDispatcherInterface $dispatcher): void
    {
        $dispatcher = $this->dispatcher ?: $dispatcher;

        $this->called = true;
        $this->priority = $dispatcher->getListenerPriority($eventName, $this->listener);

        $e = $this->stopwatch->start($this->name, 'event_listener');

        ($this->optimizedListener ?? $this->listener)($event, $eventName, $dispatcher);

        if ($e->isStarted()) {
            $e->stop();
        }

        if ($event instanceof StoppableEventInterface && $event->isPropagationStopped()) {
            $this->stoppedPropagation = true;
        }
    }
}
