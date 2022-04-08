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

use Symfony\Component\Cache\Marshaller\MarshallerInterface;

/**
 * @author Ahmed TAILOULOUTE <ahmed.tailouloute@gmail.com>
 */
class MarshallingSessionHandler implements \SessionHandlerInterface, \SessionUpdateTimestampHandlerInterface
{
    private $handler;
    private $marshaller;

    public function __construct(AbstractSessionHandler $handler, MarshallerInterface $marshaller)
    {
        $this->handler = $handler;
        $this->marshaller = $marshaller;
    }

<<<<<<< HEAD
    public function open(string $savePath, string $name): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function open($savePath, $name)
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->open($savePath, $name);
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
    public function destroy(string $sessionId): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function destroy($sessionId)
>>>>>>> origin/New-FakeMain
    {
        return $this->handler->destroy($sessionId);
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
        return $this->marshaller->unmarshall($this->handler->read($sessionId));
    }

<<<<<<< HEAD
    public function write(string $sessionId, string $data): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function write($sessionId, $data)
>>>>>>> origin/New-FakeMain
    {
        $failed = [];
        $marshalledData = $this->marshaller->marshall(['data' => $data], $failed);

        if (isset($failed['data'])) {
            return false;
        }

        return $this->handler->write($sessionId, $marshalledData['data']);
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
        return $this->handler->validateId($sessionId);
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
        return $this->handler->updateTimestamp($sessionId, $data);
    }
}
