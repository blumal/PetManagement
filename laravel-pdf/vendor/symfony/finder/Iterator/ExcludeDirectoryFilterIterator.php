<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Finder\Iterator;

/**
 * ExcludeDirectoryFilterIterator filters out directories.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @extends \FilterIterator<string, \SplFileInfo>
 * @implements \RecursiveIterator<string, \SplFileInfo>
 */
class ExcludeDirectoryFilterIterator extends \FilterIterator implements \RecursiveIterator
{
<<<<<<< HEAD
    private \Iterator $iterator;
    private bool $isRecursive;
    private array $excludedDirs = [];
    private ?string $excludedPattern = null;
=======
    private $iterator;
    private $isRecursive;
    private $excludedDirs = [];
    private $excludedPattern;
>>>>>>> origin/New-FakeMain

    /**
     * @param \Iterator $iterator    The Iterator to filter
     * @param string[]  $directories An array of directories to exclude
     */
    public function __construct(\Iterator $iterator, array $directories)
    {
        $this->iterator = $iterator;
        $this->isRecursive = $iterator instanceof \RecursiveIterator;
        $patterns = [];
        foreach ($directories as $directory) {
            $directory = rtrim($directory, '/');
            if (!$this->isRecursive || str_contains($directory, '/')) {
                $patterns[] = preg_quote($directory, '#');
            } else {
                $this->excludedDirs[$directory] = true;
            }
        }
        if ($patterns) {
            $this->excludedPattern = '#(?:^|/)(?:'.implode('|', $patterns).')(?:/|$)#';
        }

        parent::__construct($iterator);
    }

    /**
     * Filters the iterator values.
<<<<<<< HEAD
     */
    public function accept(): bool
=======
     *
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function accept()
>>>>>>> origin/New-FakeMain
    {
        if ($this->isRecursive && isset($this->excludedDirs[$this->getFilename()]) && $this->isDir()) {
            return false;
        }

        if ($this->excludedPattern) {
            $path = $this->isDir() ? $this->current()->getRelativePathname() : $this->current()->getRelativePath();
            $path = str_replace('\\', '/', $path);

            return !preg_match($this->excludedPattern, $path);
        }

        return true;
    }

<<<<<<< HEAD
    public function hasChildren(): bool
=======
    /**
     * @return bool
     */
    #[\ReturnTypeWillChange]
    public function hasChildren()
>>>>>>> origin/New-FakeMain
    {
        return $this->isRecursive && $this->iterator->hasChildren();
    }

<<<<<<< HEAD
    public function getChildren(): self
=======
    /**
     * @return self
     */
    #[\ReturnTypeWillChange]
    public function getChildren()
>>>>>>> origin/New-FakeMain
    {
        $children = new self($this->iterator->getChildren(), []);
        $children->excludedDirs = $this->excludedDirs;
        $children->excludedPattern = $this->excludedPattern;

        return $children;
    }
}
