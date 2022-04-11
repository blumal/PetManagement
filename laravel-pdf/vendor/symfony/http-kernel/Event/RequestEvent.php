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

use Symfony\Component\HttpFoundation\Response;

/**
 * Allows to create a response for a request.
 *
 * Call setResponse() to set the response that will be returned for the
 * current request. The propagation of this event is stopped as soon as a
 * response is set.
 *
 * @author Bernhard Schussek <bschussek@gmail.com>
 */
class RequestEvent extends KernelEvent
{
<<<<<<< HEAD
    private $response = null;

    /**
     * Returns the response object.
     */
    public function getResponse(): ?Response
=======
    private $response;

    /**
     * Returns the response object.
     *
     * @return Response|null
     */
    public function getResponse()
>>>>>>> origin/New-FakeMain
    {
        return $this->response;
    }

    /**
     * Sets a response and stops event propagation.
     */
    public function setResponse(Response $response)
    {
        $this->response = $response;

        $this->stopPropagation();
    }

    /**
     * Returns whether a response was set.
<<<<<<< HEAD
     */
    public function hasResponse(): bool
=======
     *
     * @return bool
     */
    public function hasResponse()
>>>>>>> origin/New-FakeMain
    {
        return null !== $this->response;
    }
}
