<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\DataCollector;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ControllerEvent;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
class RouterDataCollector extends DataCollector
{
    /**
     * @var \SplObjectStorage<Request, callable>
     */
    protected $controllers;

    public function __construct()
    {
        $this->reset();
    }

    /**
     * {@inheritdoc}
     *
     * @final
     */
    public function collect(Request $request, Response $response, \Throwable $exception = null)
    {
        if ($response instanceof RedirectResponse) {
            $this->data['redirect'] = true;
            $this->data['url'] = $response->getTargetUrl();

            if ($this->controllers->contains($request)) {
                $this->data['route'] = $this->guessRoute($request, $this->controllers[$request]);
            }
        }

        unset($this->controllers[$request]);
    }

    public function reset()
    {
        $this->controllers = new \SplObjectStorage();

        $this->data = [
            'redirect' => false,
            'url' => null,
            'route' => null,
        ];
    }

<<<<<<< HEAD
    protected function guessRoute(Request $request, string|object|array $controller)
=======
    protected function guessRoute(Request $request, $controller)
>>>>>>> origin/New-FakeMain
    {
        return 'n/a';
    }

    /**
     * Remembers the controller associated to each request.
     */
    public function onKernelController(ControllerEvent $event)
    {
        $this->controllers[$event->getRequest()] = $event->getController();
    }

    /**
     * @return bool Whether this request will result in a redirect
     */
<<<<<<< HEAD
    public function getRedirect(): bool
=======
    public function getRedirect()
>>>>>>> origin/New-FakeMain
    {
        return $this->data['redirect'];
    }

<<<<<<< HEAD
    public function getTargetUrl(): ?string
=======
    /**
     * @return string|null
     */
    public function getTargetUrl()
>>>>>>> origin/New-FakeMain
    {
        return $this->data['url'];
    }

<<<<<<< HEAD
    public function getTargetRoute(): ?string
=======
    /**
     * @return string|null
     */
    public function getTargetRoute()
>>>>>>> origin/New-FakeMain
    {
        return $this->data['route'];
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getName(): string
=======
    public function getName()
>>>>>>> origin/New-FakeMain
    {
        return 'router';
    }
}
