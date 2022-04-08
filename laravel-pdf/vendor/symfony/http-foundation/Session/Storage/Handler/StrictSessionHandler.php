<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Storage\Handler;

/**
 * Adds basic `SessionUpdateTimestampHandlerInterface` behaviors to another `SessionHandlerInterface`.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class StrictSessionHandler extends AbstractSessionHandler
{
<<<<<<< HEAD
    private \SessionHandlerInterface $handler;
    private bool $doDestroy;
=======
    private $handler;
    private $doDestroy;
>>>>>>> origin/New-FakeMain

    public function __construct(\SessionHandlerInterface $handler)
    {
        if ($handler instanceof \SessionUpdateTimestampHandlerInterface) {
            throw new \LogicException(sprintf('"%s" is already an instance of "SessionUpdateTimestampHandlerInterface", you cannot wrap it with "%s".', get_debug_type($handler), self::class));
        }

        $this->handler = $handler;
    }

<<<<<<< HEAD
    public function open(string $savePath, string $sessionName): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function open($savePath, $sessionName)
>>>>>>> origin/New-FakeMain
    {
        parent::open($savePath, $sessionName);

        return $this->handler->open($savePath, $sessionName);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function doRead(string $sessionId): string
=======
    protected function doRead(string $sessionId)
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->read($sessionId);
    }

<<<<<<< HEAD
    public function updateTimestamp(string $sessionId, string $data): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function updateTimestamp($sessionId, $data)
>>>>>>> origin/New-FakeMain
    {
        return $this->write($sessionId, $data);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function doWrite(string $sessionId, string $data): bool
=======
    protected function doWrite(string $sessionId, string $data)
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->write($sessionId, $data);
    }

<<<<<<< HEAD
    public function destroy(string $sessionId): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function destroy($sessionId)
>>>>>>> origin/New-FakeMain
    {
        $this->doDestroy = true;
        $destroyed = parent::destroy($sessionId);

        return $this->doDestroy ? $this->doDestroy($sessionId) : $destroyed;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    protected function doDestroy(string $sessionId): bool
=======
    protected function doDestroy(string $sessionId)
>>>>>>> origin/New-FakeMain
    {
        $this->doDestroy = false;

        return $this->handler->destroy($sessionId);
    }

<<<<<<< HEAD
    public function close(): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function close()
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->close();
    }

<<<<<<< HEAD
    public function gc(int $maxlifetime): int|false
=======
    /**
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($maxlifetime)
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->gc($maxlifetime);
    }
}
