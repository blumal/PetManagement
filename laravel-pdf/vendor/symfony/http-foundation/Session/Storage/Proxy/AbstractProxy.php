<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage\Proxy;

/**
 * @author Drak <drak@zikula.org>
 */
abstract class AbstractProxy
{
    /**
     * Flag if handler wraps an internal PHP session handler (using \SessionHandler).
     *
     * @var bool
     */
    protected $wrapper = false;

    /**
     * @var string
     */
    protected $saveHandlerName;

    /**
     * Gets the session.save_handler name.
<<<<<<< HEAD
     */
    public function getSaveHandlerName(): ?string
=======
     *
     * @return string|null
     */
    public function getSaveHandlerName()
>>>>>>> origin/New-FakeMain
    {
        return $this->saveHandlerName;
    }

    /**
     * Is this proxy handler and instance of \SessionHandlerInterface.
<<<<<<< HEAD
     */
    public function isSessionHandlerInterface(): bool
=======
     *
     * @return bool
     */
    public function isSessionHandlerInterface()
>>>>>>> origin/New-FakeMain
    {
        return $this instanceof \SessionHandlerInterface;
    }

    /**
     * Returns true if this handler wraps an internal PHP session save handler using \SessionHandler.
<<<<<<< HEAD
     */
    public function isWrapper(): bool
=======
     *
     * @return bool
     */
    public function isWrapper()
>>>>>>> origin/New-FakeMain
    {
        return $this->wrapper;
    }

    /**
     * Has a session started?
<<<<<<< HEAD
     */
    public function isActive(): bool
=======
     *
     * @return bool
     */
    public function isActive()
>>>>>>> origin/New-FakeMain
    {
        return \PHP_SESSION_ACTIVE === session_status();
    }

    /**
     * Gets the session ID.
<<<<<<< HEAD
     */
    public function getId(): string
=======
     *
     * @return string
     */
    public function getId()
>>>>>>> origin/New-FakeMain
    {
        return session_id();
    }

    /**
     * Sets the session ID.
     *
     * @throws \LogicException
     */
    public function setId(string $id)
    {
        if ($this->isActive()) {
            throw new \LogicException('Cannot change the ID of an active session.');
        }

        session_id($id);
    }

    /**
     * Gets the session name.
<<<<<<< HEAD
     */
    public function getName(): string
=======
     *
     * @return string
     */
    public function getName()
>>>>>>> origin/New-FakeMain
    {
        return session_name();
    }

    /**
     * Sets the session name.
     *
     * @throws \LogicException
     */
    public function setName(string $name)
    {
        if ($this->isActive()) {
            throw new \LogicException('Cannot change the name of an active session.');
        }

        session_name($name);
    }
}
