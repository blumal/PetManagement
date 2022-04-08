<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Profiler;

use Symfony\Component\HttpKernel\DataCollector\DataCollectorInterface;

/**
 * Profile.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Profile
{
<<<<<<< HEAD
    private string $token;
=======
    private $token;
>>>>>>> origin/New-FakeMain

    /**
     * @var DataCollectorInterface[]
     */
<<<<<<< HEAD
    private array $collectors = [];

    private ?string $ip = null;
    private ?string $method = null;
    private ?string $url = null;
    private ?int $time = null;
    private ?int $statusCode = null;
    private ?self $parent = null;
=======
    private $collectors = [];

    private $ip;
    private $method;
    private $url;
    private $time;
    private $statusCode;

    /**
     * @var Profile
     */
    private $parent;
>>>>>>> origin/New-FakeMain

    /**
     * @var Profile[]
     */
<<<<<<< HEAD
    private array $children = [];
=======
    private $children = [];
>>>>>>> origin/New-FakeMain

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function setToken(string $token)
    {
        $this->token = $token;
    }

    /**
     * Gets the token.
<<<<<<< HEAD
     */
    public function getToken(): string
=======
     *
     * @return string
     */
    public function getToken()
>>>>>>> origin/New-FakeMain
    {
        return $this->token;
    }

    /**
     * Sets the parent token.
     */
    public function setParent(self $parent)
    {
        $this->parent = $parent;
    }

    /**
     * Returns the parent profile.
<<<<<<< HEAD
     */
    public function getParent(): ?self
=======
     *
     * @return self|null
     */
    public function getParent()
>>>>>>> origin/New-FakeMain
    {
        return $this->parent;
    }

    /**
     * Returns the parent token.
<<<<<<< HEAD
     */
    public function getParentToken(): ?string
=======
     *
     * @return string|null
     */
    public function getParentToken()
>>>>>>> origin/New-FakeMain
    {
        return $this->parent ? $this->parent->getToken() : null;
    }

    /**
     * Returns the IP.
<<<<<<< HEAD
     */
    public function getIp(): ?string
=======
     *
     * @return string|null
     */
    public function getIp()
>>>>>>> origin/New-FakeMain
    {
        return $this->ip;
    }

    public function setIp(?string $ip)
    {
        $this->ip = $ip;
    }

    /**
     * Returns the request method.
<<<<<<< HEAD
     */
    public function getMethod(): ?string
=======
     *
     * @return string|null
     */
    public function getMethod()
>>>>>>> origin/New-FakeMain
    {
        return $this->method;
    }

    public function setMethod(string $method)
    {
        $this->method = $method;
    }

    /**
     * Returns the URL.
<<<<<<< HEAD
     */
    public function getUrl(): ?string
=======
     *
     * @return string|null
     */
    public function getUrl()
>>>>>>> origin/New-FakeMain
    {
        return $this->url;
    }

    public function setUrl(?string $url)
    {
        $this->url = $url;
    }

<<<<<<< HEAD
    public function getTime(): int
=======
    /**
     * @return int
     */
    public function getTime()
>>>>>>> origin/New-FakeMain
    {
        return $this->time ?? 0;
    }

    public function setTime(int $time)
    {
        $this->time = $time;
    }

    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

<<<<<<< HEAD
    public function getStatusCode(): ?int
=======
    /**
     * @return int|null
     */
    public function getStatusCode()
>>>>>>> origin/New-FakeMain
    {
        return $this->statusCode;
    }

    /**
     * Finds children profilers.
     *
     * @return self[]
     */
<<<<<<< HEAD
    public function getChildren(): array
=======
    public function getChildren()
>>>>>>> origin/New-FakeMain
    {
        return $this->children;
    }

    /**
     * Sets children profiler.
     *
     * @param Profile[] $children
     */
    public function setChildren(array $children)
    {
        $this->children = [];
        foreach ($children as $child) {
            $this->addChild($child);
        }
    }

    /**
     * Adds the child token.
     */
    public function addChild(self $child)
    {
        $this->children[] = $child;
        $child->setParent($this);
    }

    public function getChildByToken(string $token): ?self
    {
        foreach ($this->children as $child) {
            if ($token === $child->getToken()) {
                return $child;
            }
        }

        return null;
    }

    /**
     * Gets a Collector by name.
     *
<<<<<<< HEAD
     * @throws \InvalidArgumentException if the collector does not exist
     */
    public function getCollector(string $name): DataCollectorInterface
=======
     * @return DataCollectorInterface
     *
     * @throws \InvalidArgumentException if the collector does not exist
     */
    public function getCollector(string $name)
>>>>>>> origin/New-FakeMain
    {
        if (!isset($this->collectors[$name])) {
            throw new \InvalidArgumentException(sprintf('Collector "%s" does not exist.', $name));
        }

        return $this->collectors[$name];
    }

    /**
     * Gets the Collectors associated with this profile.
     *
     * @return DataCollectorInterface[]
     */
<<<<<<< HEAD
    public function getCollectors(): array
=======
    public function getCollectors()
>>>>>>> origin/New-FakeMain
    {
        return $this->collectors;
    }

    /**
     * Sets the Collectors associated with this profile.
     *
     * @param DataCollectorInterface[] $collectors
     */
    public function setCollectors(array $collectors)
    {
        $this->collectors = [];
        foreach ($collectors as $collector) {
            $this->addCollector($collector);
        }
    }

    /**
     * Adds a Collector.
     */
    public function addCollector(DataCollectorInterface $collector)
    {
        $this->collectors[$collector->getName()] = $collector;
    }

<<<<<<< HEAD
    public function hasCollector(string $name): bool
=======
    /**
     * @return bool
     */
    public function hasCollector(string $name)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->collectors[$name]);
    }

<<<<<<< HEAD
    public function __sleep(): array
=======
    /**
     * @return array
     */
    public function __sleep()
>>>>>>> origin/New-FakeMain
    {
        return ['token', 'parent', 'children', 'collectors', 'ip', 'method', 'url', 'time', 'statusCode'];
    }
}
