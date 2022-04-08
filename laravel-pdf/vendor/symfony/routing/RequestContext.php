<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Routing;

use Symfony\Component\HttpFoundation\Request;

/**
 * Holds information about the current request.
 *
 * This class implements a fluent interface.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Tobias Schultze <http://tobion.de>
 */
class RequestContext
{
<<<<<<< HEAD
    private string $baseUrl;
    private string $pathInfo;
    private string $method;
    private string $host;
    private string $scheme;
    private int $httpPort;
    private int $httpsPort;
    private string $queryString;
    private array $parameters = [];
=======
    private $baseUrl;
    private $pathInfo;
    private $method;
    private $host;
    private $scheme;
    private $httpPort;
    private $httpsPort;
    private $queryString;
    private $parameters = [];
>>>>>>> origin/New-FakeMain

    public function __construct(string $baseUrl = '', string $method = 'GET', string $host = 'localhost', string $scheme = 'http', int $httpPort = 80, int $httpsPort = 443, string $path = '/', string $queryString = '')
    {
        $this->setBaseUrl($baseUrl);
        $this->setMethod($method);
        $this->setHost($host);
        $this->setScheme($scheme);
        $this->setHttpPort($httpPort);
        $this->setHttpsPort($httpsPort);
        $this->setPathInfo($path);
        $this->setQueryString($queryString);
    }

    public static function fromUri(string $uri, string $host = 'localhost', string $scheme = 'http', int $httpPort = 80, int $httpsPort = 443): self
    {
        $uri = parse_url($uri);
        $scheme = $uri['scheme'] ?? $scheme;
        $host = $uri['host'] ?? $host;

        if (isset($uri['port'])) {
            if ('http' === $scheme) {
                $httpPort = $uri['port'];
            } elseif ('https' === $scheme) {
                $httpsPort = $uri['port'];
            }
        }

        return new self($uri['path'] ?? '', 'GET', $host, $scheme, $httpPort, $httpsPort);
    }

    /**
     * Updates the RequestContext information based on a HttpFoundation Request.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function fromRequest(Request $request): static
=======
    public function fromRequest(Request $request)
>>>>>>> origin/New-FakeMain
    {
        $this->setBaseUrl($request->getBaseUrl());
        $this->setPathInfo($request->getPathInfo());
        $this->setMethod($request->getMethod());
        $this->setHost($request->getHost());
        $this->setScheme($request->getScheme());
        $this->setHttpPort($request->isSecure() || null === $request->getPort() ? $this->httpPort : $request->getPort());
        $this->setHttpsPort($request->isSecure() && null !== $request->getPort() ? $request->getPort() : $this->httpsPort);
        $this->setQueryString($request->server->get('QUERY_STRING', ''));

        return $this;
    }

    /**
     * Gets the base URL.
<<<<<<< HEAD
     */
    public function getBaseUrl(): string
=======
     *
     * @return string
     */
    public function getBaseUrl()
>>>>>>> origin/New-FakeMain
    {
        return $this->baseUrl;
    }

    /**
     * Sets the base URL.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setBaseUrl(string $baseUrl): static
=======
    public function setBaseUrl(string $baseUrl)
>>>>>>> origin/New-FakeMain
    {
        $this->baseUrl = $baseUrl;

        return $this;
    }

    /**
     * Gets the path info.
<<<<<<< HEAD
     */
    public function getPathInfo(): string
=======
     *
     * @return string
     */
    public function getPathInfo()
>>>>>>> origin/New-FakeMain
    {
        return $this->pathInfo;
    }

    /**
     * Sets the path info.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setPathInfo(string $pathInfo): static
=======
    public function setPathInfo(string $pathInfo)
>>>>>>> origin/New-FakeMain
    {
        $this->pathInfo = $pathInfo;

        return $this;
    }

    /**
     * Gets the HTTP method.
     *
     * The method is always an uppercased string.
<<<<<<< HEAD
     */
    public function getMethod(): string
=======
     *
     * @return string
     */
    public function getMethod()
>>>>>>> origin/New-FakeMain
    {
        return $this->method;
    }

    /**
     * Sets the HTTP method.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setMethod(string $method): static
=======
    public function setMethod(string $method)
>>>>>>> origin/New-FakeMain
    {
        $this->method = strtoupper($method);

        return $this;
    }

    /**
     * Gets the HTTP host.
     *
     * The host is always lowercased because it must be treated case-insensitive.
<<<<<<< HEAD
     */
    public function getHost(): string
=======
     *
     * @return string
     */
    public function getHost()
>>>>>>> origin/New-FakeMain
    {
        return $this->host;
    }

    /**
     * Sets the HTTP host.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setHost(string $host): static
=======
    public function setHost(string $host)
>>>>>>> origin/New-FakeMain
    {
        $this->host = strtolower($host);

        return $this;
    }

    /**
     * Gets the HTTP scheme.
<<<<<<< HEAD
     */
    public function getScheme(): string
=======
     *
     * @return string
     */
    public function getScheme()
>>>>>>> origin/New-FakeMain
    {
        return $this->scheme;
    }

    /**
     * Sets the HTTP scheme.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setScheme(string $scheme): static
=======
    public function setScheme(string $scheme)
>>>>>>> origin/New-FakeMain
    {
        $this->scheme = strtolower($scheme);

        return $this;
    }

    /**
     * Gets the HTTP port.
<<<<<<< HEAD
     */
    public function getHttpPort(): int
=======
     *
     * @return int
     */
    public function getHttpPort()
>>>>>>> origin/New-FakeMain
    {
        return $this->httpPort;
    }

    /**
     * Sets the HTTP port.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setHttpPort(int $httpPort): static
=======
    public function setHttpPort(int $httpPort)
>>>>>>> origin/New-FakeMain
    {
        $this->httpPort = $httpPort;

        return $this;
    }

    /**
     * Gets the HTTPS port.
<<<<<<< HEAD
     */
    public function getHttpsPort(): int
=======
     *
     * @return int
     */
    public function getHttpsPort()
>>>>>>> origin/New-FakeMain
    {
        return $this->httpsPort;
    }

    /**
     * Sets the HTTPS port.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setHttpsPort(int $httpsPort): static
=======
    public function setHttpsPort(int $httpsPort)
>>>>>>> origin/New-FakeMain
    {
        $this->httpsPort = $httpsPort;

        return $this;
    }

    /**
     * Gets the query string without the "?".
<<<<<<< HEAD
     */
    public function getQueryString(): string
=======
     *
     * @return string
     */
    public function getQueryString()
>>>>>>> origin/New-FakeMain
    {
        return $this->queryString;
    }

    /**
     * Sets the query string.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setQueryString(?string $queryString): static
=======
    public function setQueryString(?string $queryString)
>>>>>>> origin/New-FakeMain
    {
        // string cast to be fault-tolerant, accepting null
        $this->queryString = (string) $queryString;

        return $this;
    }

    /**
     * Returns the parameters.
<<<<<<< HEAD
     */
    public function getParameters(): array
=======
     *
     * @return array
     */
    public function getParameters()
>>>>>>> origin/New-FakeMain
    {
        return $this->parameters;
    }

    /**
     * Sets the parameters.
     *
     * @param array $parameters The parameters
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setParameters(array $parameters): static
=======
    public function setParameters(array $parameters)
>>>>>>> origin/New-FakeMain
    {
        $this->parameters = $parameters;

        return $this;
    }

    /**
     * Gets a parameter value.
<<<<<<< HEAD
     */
    public function getParameter(string $name): mixed
=======
     *
     * @return mixed
     */
    public function getParameter(string $name)
>>>>>>> origin/New-FakeMain
    {
        return $this->parameters[$name] ?? null;
    }

    /**
     * Checks if a parameter value is set for the given parameter.
<<<<<<< HEAD
     */
    public function hasParameter(string $name): bool
=======
     *
     * @return bool
     */
    public function hasParameter(string $name)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($name, $this->parameters);
    }

    /**
     * Sets a parameter value.
     *
<<<<<<< HEAD
     * @return $this
     */
    public function setParameter(string $name, mixed $parameter): static
=======
     * @param mixed $parameter The parameter value
     *
     * @return $this
     */
    public function setParameter(string $name, $parameter)
>>>>>>> origin/New-FakeMain
    {
        $this->parameters[$name] = $parameter;

        return $this;
    }

    public function isSecure(): bool
    {
        return 'https' === $this->scheme;
    }
}
