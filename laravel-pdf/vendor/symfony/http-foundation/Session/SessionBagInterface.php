<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session;

/**
 * Session Bag store.
 *
 * @author Drak <drak@zikula.org>
 */
interface SessionBagInterface
{
    /**
     * Gets this bag's name.
<<<<<<< HEAD
     */
    public function getName(): string;
=======
     *
     * @return string
     */
    public function getName();
>>>>>>> origin/New-FakeMain

    /**
     * Initializes the Bag.
     */
    public function initialize(array &$array);

    /**
     * Gets the storage key for this bag.
<<<<<<< HEAD
     */
    public function getStorageKey(): string;
=======
     *
     * @return string
     */
    public function getStorageKey();
>>>>>>> origin/New-FakeMain

    /**
     * Clears out data from bag.
     *
     * @return mixed Whatever data was contained
     */
<<<<<<< HEAD
    public function clear(): mixed;
=======
    public function clear();
>>>>>>> origin/New-FakeMain
}
