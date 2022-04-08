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

use Symfony\Component\Finder\Comparator\NumberComparator;

/**
 * SizeRangeFilterIterator filters out files that are not in the given size range.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @extends \FilterIterator<string, \SplFileInfo>
 */
class SizeRangeFilterIterator extends \FilterIterator
{
<<<<<<< HEAD
    private array $comparators = [];
=======
    private $comparators = [];
>>>>>>> origin/New-FakeMain

    /**
     * @param \Iterator<string, \SplFileInfo> $iterator
     * @param NumberComparator[]              $comparators
     */
    public function __construct(\Iterator $iterator, array $comparators)
    {
        $this->comparators = $comparators;

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
        $fileinfo = $this->current();
        if (!$fileinfo->isFile()) {
            return true;
        }

        $filesize = $fileinfo->getSize();
        foreach ($this->comparators as $compare) {
            if (!$compare->test($filesize)) {
                return false;
            }
        }

        return true;
    }
}
