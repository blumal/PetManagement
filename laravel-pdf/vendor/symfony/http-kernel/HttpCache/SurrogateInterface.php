<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\HttpCache;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

interface SurrogateInterface
{
    /**
     * Returns surrogate name.
<<<<<<< HEAD
     */
    public function getName(): string;

    /**
     * Returns a new cache strategy instance.
     */
    public function createCacheStrategy(): ResponseCacheStrategyInterface;

    /**
     * Checks that at least one surrogate has Surrogate capability.
     */
    public function hasSurrogateCapability(Request $request): bool;
=======
     *
     * @return string
     */
    public function getName();

    /**
     * Returns a new cache strategy instance.
     *
     * @return ResponseCacheStrategyInterface
     */
    public function createCacheStrategy();

    /**
     * Checks that at least one surrogate has Surrogate capability.
     *
     * @return bool
     */
    public function hasSurrogateCapability(Request $request);
>>>>>>> origin/New-FakeMain

    /**
     * Adds Surrogate-capability to the given Request.
     */
    public function addSurrogateCapability(Request $request);

    /**
     * Adds HTTP headers to specify that the Response needs to be parsed for Surrogate.
     *
     * This method only adds an Surrogate HTTP header if the Response has some Surrogate tags.
     */
    public function addSurrogateControl(Response $response);

    /**
     * Checks that the Response needs to be parsed for Surrogate tags.
<<<<<<< HEAD
     */
    public function needsParsing(Response $response): bool;
=======
     *
     * @return bool
     */
    public function needsParsing(Response $response);
>>>>>>> origin/New-FakeMain

    /**
     * Renders a Surrogate tag.
     *
     * @param string $alt     An alternate URI
     * @param string $comment A comment to add as an esi:include tag
<<<<<<< HEAD
     */
    public function renderIncludeTag(string $uri, string $alt = null, bool $ignoreErrors = true, string $comment = ''): string;

    /**
     * Replaces a Response Surrogate tags with the included resource content.
     */
    public function process(Request $request, Response $response): Response;
=======
     *
     * @return string
     */
    public function renderIncludeTag(string $uri, string $alt = null, bool $ignoreErrors = true, string $comment = '');

    /**
     * Replaces a Response Surrogate tags with the included resource content.
     *
     * @return Response
     */
    public function process(Request $request, Response $response);
>>>>>>> origin/New-FakeMain

    /**
     * Handles a Surrogate from the cache.
     *
     * @param string $alt An alternative URI
     *
<<<<<<< HEAD
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function handle(HttpCache $cache, string $uri, string $alt, bool $ignoreErrors): string;
=======
     * @return string
     *
     * @throws \RuntimeException
     * @throws \Exception
     */
    public function handle(HttpCache $cache, string $uri, string $alt, bool $ignoreErrors);
>>>>>>> origin/New-FakeMain
}
