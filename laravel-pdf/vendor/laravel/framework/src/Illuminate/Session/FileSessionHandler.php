<?php

namespace Illuminate\Session;

use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Carbon;
use SessionHandlerInterface;
use Symfony\Component\Finder\Finder;

class FileSessionHandler implements SessionHandlerInterface
{
    /**
     * The filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
     * The path where sessions should be stored.
     *
     * @var string
     */
    protected $path;

    /**
     * The number of minutes the session should be valid.
     *
     * @var int
     */
    protected $minutes;

    /**
     * Create a new file driven handler instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $path
     * @param  int  $minutes
     * @return void
     */
    public function __construct(Filesystem $files, $path, $minutes)
    {
        $this->path = $path;
        $this->files = $files;
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
    {
        if ($this->files->isFile($path = $this->path.'/'.$sessionId) &&
            $this->files->lastModified($path) >= Carbon::now()->subMinutes($this->minutes)->getTimestamp()) {
            return $this->files->sharedGet($path);
=======
    #[\ReturnTypeWillChange]
    public function read($sessionId)
    {
        if ($this->files->isFile($path = $this->path.'/'.$sessionId)) {
            if ($this->files->lastModified($path) >= Carbon::now()->subMinutes($this->minutes)->getTimestamp()) {
                return $this->files->sharedGet($path);
            }
>>>>>>> origin/New-FakeMain
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
        $this->files->put($this->path.'/'.$sessionId, $data, true);

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
        $this->files->delete($this->path.'/'.$sessionId);

        return true;
    }

    /**
     * {@inheritdoc}
     *
<<<<<<< HEAD
     * @return int
     */
    public function gc($lifetime): int
=======
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function gc($lifetime)
>>>>>>> origin/New-FakeMain
    {
        $files = Finder::create()
                    ->in($this->path)
                    ->files()
                    ->ignoreDotFiles(true)
                    ->date('<= now - '.$lifetime.' seconds');

<<<<<<< HEAD
        $deletedSessions = 0;

        foreach ($files as $file) {
            $this->files->delete($file->getRealPath());
            $deletedSessions++;
        }

        return $deletedSessions;
=======
        foreach ($files as $file) {
            $this->files->delete($file->getRealPath());
        }
>>>>>>> origin/New-FakeMain
    }
}
