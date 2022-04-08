<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\File;

/**
 * A PHP stream of unknown size.
 *
 * @author Nicolas Grekas <p@tchwork.com>
 */
class Stream extends File
{
<<<<<<< HEAD
    public function getSize(): int|false
=======
    /**
     * {@inheritdoc}
     *
     * @return int|false
     */
    #[\ReturnTypeWillChange]
    public function getSize()
>>>>>>> origin/New-FakeMain
    {
        return false;
    }
}
