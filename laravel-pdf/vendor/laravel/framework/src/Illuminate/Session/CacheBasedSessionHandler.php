<?php

namespace Illuminate\Session;

use Illuminate\Contracts\Cache\Repository as CacheContract;
use SessionHandlerInterface;

class CacheBasedSessionHandler implements SessionHandlerInterface
{
    /**
     * The cache repository instance.
     *
     * @var \Illuminate\Contracts\Cache\Repository
     */
    protected $cache;

    /**
     * The number of minutes to store the data in the cache.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new cache driven handler instance.
     *
     * @param  \Illuminate\Contracts\Cache\Repository  $cache
     * @param  int  $minutes
     * @return void
     */
    public function __construct(CacheContract $cache, $minutes)
    {
        $this->cache = $cache;
        $this->minutes = $minutes;
    }

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
        return $this->cache->get($sessionId, '');
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
        return $this->cache->put($sessionId, $data, $this->minutes * 60);
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
        return $this->cache->forget($sessionId);
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

    /**
     * Get the underlying cache repository.
     *
     * @return \Illuminate\Contracts\Cache\Repository
     */
    public function getCache()
    {
        return $this->cache;
    }
}
