<?php

namespace Illuminate\Session;

use Illuminate\Support\InteractsWithTime;
use SessionHandlerInterface;

class ArraySessionHandler implements SessionHandlerInterface
{
    use InteractsWithTime;

    /**
     * The array of stored values.
     *
     * @var array
     */
    protected $storage = [];

    /**
     * The number of minutes the session should be valid.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new array driven handler instance.
     *
     * @param  int  $minutes
     * @return void
     */
    public function __construct($minutes)
    {
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
     * @return string|false
     */
<<<<<<< HEAD
    public function read($sessionId): string|false
=======
    #[\ReturnTypeWillChange]
    public function read($sessionId)
>>>>>>> origin/New-FakeMain
    {
        if (! isset($this->storage[$sessionId])) {
            return '';
        }

        $session = $this->storage[$sessionId];

        $expiration = $this->calculateExpiration($this->minutes * 60);

        if (isset($session['time']) && $session['time'] >= $expiration) {
            return $session['data'];
        }

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
        $this->storage[$sessionId] = [
            'data' => $data,
            'time' => $this->currentTime(),
        ];

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
        if (isset($this->storage[$sessionId])) {
            unset($this->storage[$sessionId]);
        }

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
        $expiration = $this->calculateExpiration($lifetime);

        $deletedSessions = 0;

        foreach ($this->storage as $sessionId => $session) {
            if ($session['time'] < $expiration) {
                unset($this->storage[$sessionId]);
                $deletedSessions++;
            }
        }

        return $deletedSessions;
=======
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($lifetime)
    {
        $expiration = $this->calculateExpiration($lifetime);

        foreach ($this->storage as $sessionId => $session) {
            if ($session['time'] < $expiration) {
                unset($this->storage[$sessionId]);
            }
        }

        return true;
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the expiration time of the session.
     *
     * @param  int  $seconds
     * @return int
     */
    protected function calculateExpiration($seconds)
    {
        return $this->currentTime() - $seconds;
    }
}
