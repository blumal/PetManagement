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
 * FilecontentFilterIterator filters files by their contents using patterns (regexps or strings).
 *
 * @author Fabien Potencier  <fabien@symfony.com>
 * @author Włodzimierz Gajda <gajdaw@gajdaw.pl>
 *
 * @extends MultiplePcreFilterIterator<string, \SplFileInfo>
 */
class FilecontentFilterIterator extends MultiplePcreFilterIterator
{
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
        if (!$this->matchRegexps && !$this->noMatchRegexps) {
            return true;
        }

        $fileinfo = $this->current();

        if ($fileinfo->isDir() || !$fileinfo->isReadable()) {
            return false;
        }

        $content = $fileinfo->getContents();
        if (!$content) {
            return false;
        }

        return $this->isAccepted($content);
    }

    /**
     * Converts string to regexp if necessary.
     *
     * @param string $str Pattern: string or regexp
<<<<<<< HEAD
     */
    protected function toRegex(string $str): string
=======
     *
     * @return string
     */
    protected function toRegex(string $str)
>>>>>>> origin/New-FakeMain
    {
        return $this->isRegex($str) ? $str : '/'.preg_quote($str, '/').'/';
    }
}
