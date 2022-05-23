<?php

namespace Illuminate\View\Compilers;

use Illuminate\Filesystem\Filesystem;
<<<<<<< HEAD
use Illuminate\Support\Str;
=======
>>>>>>> origin/New-FakeMain
use InvalidArgumentException;

abstract class Compiler
{
    /**
<<<<<<< HEAD
     * The filesystem instance.
=======
     * The Filesystem instance.
>>>>>>> origin/New-FakeMain
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    /**
<<<<<<< HEAD
     * The cache path for the compiled views.
=======
     * Get the cache path for the compiled views.
>>>>>>> origin/New-FakeMain
     *
     * @var string
     */
    protected $cachePath;

    /**
<<<<<<< HEAD
     * The base path that should be removed from paths before hashing.
     *
     * @var string
     */
    protected $basePath;

    /**
=======
>>>>>>> origin/New-FakeMain
     * Create a new compiler instance.
     *
     * @param  \Illuminate\Filesystem\Filesystem  $files
     * @param  string  $cachePath
<<<<<<< HEAD
     * @param  string  $basePath
=======
>>>>>>> origin/New-FakeMain
     * @return void
     *
     * @throws \InvalidArgumentException
     */
<<<<<<< HEAD
    public function __construct(Filesystem $files, $cachePath, $basePath = '')
=======
    public function __construct(Filesystem $files, $cachePath)
>>>>>>> origin/New-FakeMain
    {
        if (! $cachePath) {
            throw new InvalidArgumentException('Please provide a valid cache path.');
        }

        $this->files = $files;
        $this->cachePath = $cachePath;
<<<<<<< HEAD
        $this->basePath = $basePath;
=======
>>>>>>> origin/New-FakeMain
    }

    /**
     * Get the path to the compiled version of a view.
     *
     * @param  string  $path
     * @return string
     */
    public function getCompiledPath($path)
    {
<<<<<<< HEAD
        return $this->cachePath.'/'.sha1('v2'.Str::after($path, $this->basePath)).'.php';
=======
        return $this->cachePath.'/'.sha1('v2'.$path).'.php';
>>>>>>> origin/New-FakeMain
    }

    /**
     * Determine if the view at the given path is expired.
     *
     * @param  string  $path
     * @return bool
     */
    public function isExpired($path)
    {
        $compiled = $this->getCompiledPath($path);

        // If the compiled file doesn't exist we will indicate that the view is expired
        // so that it can be re-compiled. Else, we will verify the last modification
        // of the views is less than the modification times of the compiled views.
        if (! $this->files->exists($compiled)) {
            return true;
        }

        return $this->files->lastModified($path) >=
               $this->files->lastModified($compiled);
    }

    /**
     * Create the compiled file directory if necessary.
     *
     * @param  string  $path
     * @return void
     */
    protected function ensureCompiledDirectoryExists($path)
    {
        if (! $this->files->exists(dirname($path))) {
            $this->files->makeDirectory(dirname($path), 0777, true, true);
        }
    }
}
