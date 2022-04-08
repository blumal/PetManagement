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
 * Migrating session handler for migrating from one handler to another. It reads
 * from the current handler and writes both the current and new ones.
 *
 * It ignores errors from the new handler.
 *
 * @author Ross Motley <ross.motley@amara.com>
 * @author Oliver Radwell <oliver.radwell@amara.com>
 */
class MigratingSessionHandler implements \SessionHandlerInterface, \SessionUpdateTimestampHandlerInterface
{
    /**
     * @var \SessionHandlerInterface&\SessionUpdateTimestampHandlerInterface
     */
<<<<<<< HEAD
    private \SessionHandlerInterface $currentHandler;
=======
    private $currentHandler;
>>>>>>> origin/New-FakeMain

    /**
     * @var \SessionHandlerInterface&\SessionUpdateTimestampHandlerInterface
     */
<<<<<<< HEAD
    private \SessionHandlerInterface $writeOnlyHandler;
=======
    private $writeOnlyHandler;
>>>>>>> origin/New-FakeMain

    public function __construct(\SessionHandlerInterface $currentHandler, \SessionHandlerInterface $writeOnlyHandler)
    {
        if (!$currentHandler instanceof \SessionUpdateTimestampHandlerInterface) {
            $currentHandler = new StrictSessionHandler($currentHandler);
        }
        if (!$writeOnlyHandler instanceof \SessionUpdateTimestampHandlerInterface) {
            $writeOnlyHandler = new StrictSessionHandler($writeOnlyHandler);
        }

        $this->currentHandler = $currentHandler;
        $this->writeOnlyHandler = $writeOnlyHandler;
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
        $result = $this->currentHandler->close();
        $this->writeOnlyHandler->close();

        return $result;
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
        $result = $this->currentHandler->destroy($sessionId);
        $this->writeOnlyHandler->destroy($sessionId);

        return $result;
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
        $result = $this->currentHandler->gc($maxlifetime);
        $this->writeOnlyHandler->gc($maxlifetime);

        return $result;
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
        $result = $this->currentHandler->open($savePath, $sessionName);
        $this->writeOnlyHandler->open($savePath, $sessionName);

        return $result;
    }

<<<<<<< HEAD
    public function read(string $sessionId): string
=======
    /**
     * @return string
     */
    #[\ReturnTypeWillChange]
    public function read($sessionId)
>>>>>>> origin/New-FakeMain
    {
        // No reading from new handler until switch-over
        return $this->currentHandler->read($sessionId);
    }

<<<<<<< HEAD
    public function write(string $sessionId, string $sessionData): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function write($sessionId, $sessionData)
>>>>>>> origin/New-FakeMain
    {
        $result = $this->currentHandler->write($sessionId, $sessionData);
        $this->writeOnlyHandler->write($sessionId, $sessionData);

        return $result;
    }

<<<<<<< HEAD
    public function validateId(string $sessionId): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function validateId($sessionId)
>>>>>>> origin/New-FakeMain
    {
        // No reading from new handler until switch-over
        return $this->currentHandler->validateId($sessionId);
    }

<<<<<<< HEAD
    public function updateTimestamp(string $sessionId, string $sessionData): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function updateTimestamp($sessionId, $sessionData)
>>>>>>> origin/New-FakeMain
    {
        $result = $this->currentHandler->updateTimestamp($sessionId, $sessionData);
        $this->writeOnlyHandler->updateTimestamp($sessionId, $sessionData);

        return $result;
    }
}
