<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Event;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Contracts\EventDispatcher\Event;

/**
 * Base class for events thrown in the HttpKernel component.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class KernelEvent extends Event
{
    private $kernel;
    private $request;
<<<<<<< HEAD
    private ?int $requestType;
=======
    private $requestType;
>>>>>>> origin/New-FakeMain

    /**
     * @param int $requestType The request type the kernel is currently processing; one of
     *                         HttpKernelInterface::MAIN_REQUEST or HttpKernelInterface::SUB_REQUEST
     */
    public function __construct(HttpKernelInterface $kernel, Request $request, ?int $requestType)
    {
        $this->kernel = $kernel;
        $this->request = $request;
        $this->requestType = $requestType;
    }

    /**
     * Returns the kernel in which this event was thrown.
<<<<<<< HEAD
     */
    public function getKernel(): HttpKernelInterface
=======
     *
     * @return HttpKernelInterface
     */
    public function getKernel()
>>>>>>> origin/New-FakeMain
    {
        return $this->kernel;
    }

    /**
     * Returns the request the kernel is currently processing.
<<<<<<< HEAD
     */
    public function getRequest(): Request
=======
     *
     * @return Request
     */
    public function getRequest()
>>>>>>> origin/New-FakeMain
    {
        return $this->request;
    }

    /**
     * Returns the request type the kernel is currently processing.
     *
     * @return int One of HttpKernelInterface::MAIN_REQUEST and
     *             HttpKernelInterface::SUB_REQUEST
     */
<<<<<<< HEAD
    public function getRequestType(): int
=======
    public function getRequestType()
>>>>>>> origin/New-FakeMain
    {
        return $this->requestType;
    }

    /**
     * Checks if this is the main request.
     */
    public function isMainRequest(): bool
    {
        return HttpKernelInterface::MAIN_REQUEST === $this->requestType;
    }
<<<<<<< HEAD
=======

    /**
     * Checks if this is a master request.
     *
     * @return bool
     *
     * @deprecated since symfony/http-kernel 5.3, use isMainRequest() instead
     */
    public function isMasterRequest()
    {
        trigger_deprecation('symfony/http-kernel', '5.3', '"%s()" is deprecated, use "isMainRequest()" instead.', __METHOD__);

        return $this->isMainRequest();
    }
>>>>>>> origin/New-FakeMain
}
