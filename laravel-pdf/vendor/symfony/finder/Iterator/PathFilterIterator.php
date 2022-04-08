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
 * PathFilterIterator filters files by path patterns (e.g. some/special/dir).
 *
 * @author Fabien Potencier  <fabien@symfony.com>
 * @author Włodzimierz Gajda <gajdaw@gajdaw.pl>
 *
 * @extends MultiplePcreFilterIterator<string, \SplFileInfo>
 */
class PathFilterIterator extends MultiplePcreFilterIterator
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
        $filename = $this->current()->getRelativePathname();

        if ('\\' === \DIRECTORY_SEPARATOR) {
            $filename = str_replace('\\', '/', $filename);
        }

        return $this->isAccepted($filename);
    }

    /**
     * Converts strings to regexp.
     *
     * PCRE patterns are left unchanged.
     *
     * Default conversion:
     *     'lorem/ipsum/dolor' ==>  'lorem\/ipsum\/dolor/'
     *
     * Use only / as directory separator (on Windows also).
     *
     * @param string $str Pattern: regexp or dirname
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
