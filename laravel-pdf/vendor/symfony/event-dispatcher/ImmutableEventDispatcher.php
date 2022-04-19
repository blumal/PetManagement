<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\EventDispatcher;

/**
 * A read-only proxy for an event dispatcher.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class ImmutableEventDispatcher implements EventDispatcherInterface
{
    private $dispatcher;

    public function __construct(EventDispatcherInterface $dispatcher)
    {
        $this->dispatcher = $dispatcher;
    }

    /**
     * {@inheritdoc}
     */
    public function dispatch(object $event, string $eventName = null): object
    {
        return $this->dispatcher->dispatch($event, $eventName);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function addListener(string $eventName, callable|array $listener, int $priority = 0)
=======
    public function addListener(string $eventName, $listener, int $priority = 0)
>>>>>>> origin/New-FakeMain
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function addSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function removeListener(string $eventName, callable|array $listener)
=======
    public function removeListener(string $eventName, $listener)
>>>>>>> origin/New-FakeMain
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
    public function removeSubscriber(EventSubscriberInterface $subscriber)
    {
        throw new \BadMethodCallException('Unmodifiable event dispatchers must not be modified.');
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getListeners(string $eventName = null): array
=======
    public function getListeners(string $eventName = null)
>>>>>>> origin/New-FakeMain
    {
        return $this->dispatcher->getListeners($eventName);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getListenerPriority(string $eventName, callable|array $listener): ?int
=======
    public function getListenerPriority(string $eventName, $listener)
>>>>>>> origin/New-FakeMain
    {
        return $this->dispatcher->getListenerPriority($eventName, $listener);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function hasListeners(string $eventName = null): bool
=======
    public function hasListeners(string $eventName = null)
>>>>>>> origin/New-FakeMain
    {
        return $this->dispatcher->hasListeners($eventName);
    }
}
