<?php

namespace League\Flysystem;

<<<<<<< HEAD
use RuntimeException;

final class CorruptedPathDetected extends RuntimeException implements FilesystemException
{
    public static function forPath(string $path): CorruptedPathDetected
=======
use LogicException;

class CorruptedPathDetected extends LogicException implements FilesystemException
{
    /**
     * @param string $path
     * @return CorruptedPathDetected
     */
    public static function forPath($path)
>>>>>>> origin/New-FakeMain
    {
        return new CorruptedPathDetected("Corrupted path detected: " . $path);
    }
}
