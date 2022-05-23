<?php

namespace Illuminate\Session;

use SessionHandlerInterface;

class NullSessionHandler implements SessionHandlerInterface
{
    /**
     * {@inheritdoc}
     *
     * @return bool
     */
<<<<<<< HEAD
    public function open($savePath, $sessionName): bool
=======
    #[\ReturnTypeWillChange]
    public function open($savePath, $sessionName)
>>>>>>> origin/New-FakeMain
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
<<<<<<< HEAD
    public function close(): bool
=======
    #[\ReturnTypeWillChange]
    public function close()
>>>>>>> origin/New-FakeMain
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
<<<<<<< HEAD
     * @return string
     */
    public function read($sessionId): string
=======
     * @return string|false
     */
    #[\ReturnTypeWillChange]
    public function read($sessionId)
>>>>>>> origin/New-FakeMain
    {
        return '';
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
<<<<<<< HEAD
    public function write($sessionId, $data): bool
=======
    #[\ReturnTypeWillChange]
    public function write($sessionId, $data)
>>>>>>> origin/New-FakeMain
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
     * @return bool
     */
<<<<<<< HEAD
    public function destroy($sessionId): bool
=======
    #[\ReturnTypeWillChange]
    public function destroy($sessionId)
>>>>>>> origin/New-FakeMain
    {
        return true;
    }

    /**
     * {@inheritdoc}
     *
<<<<<<< HEAD
     * @return int
     */
    public function gc($lifetime): int
    {
        return 0;
=======
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($lifetime)
    {
        return true;
>>>>>>> origin/New-FakeMain
    }
}
