<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\CommandLoader;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Exception\CommandNotFoundException;

/**
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
interface CommandLoaderInterface
{
    /**
     * Loads a command.
     *
<<<<<<< HEAD
     * @throws CommandNotFoundException
     */
    public function get(string $name): Command;

    /**
     * Checks if a command exists.
     */
    public function has(string $name): bool;
=======
     * @return Command
     *
     * @throws CommandNotFoundException
     */
    public function get(string $name);

    /**
     * Checks if a command exists.
     *
     * @return bool
     */
    public function has(string $name);
>>>>>>> origin/New-FakeMain

    /**
     * @return string[]
     */
<<<<<<< HEAD
    public function getNames(): array;
=======
    public function getNames();
>>>>>>> origin/New-FakeMain
}
