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

<<<<<<< HEAD
use Symfony\Component\Console\Command\Command;
=======
>>>>>>> origin/New-FakeMain
use Symfony\Component\Console\Exception\CommandNotFoundException;

/**
 * A simple command loader using factories to instantiate commands lazily.
 *
 * @author Maxime Steinhausser <maxime.steinhausser@gmail.com>
 */
class FactoryCommandLoader implements CommandLoaderInterface
{
<<<<<<< HEAD
    private array $factories;
=======
    private $factories;
>>>>>>> origin/New-FakeMain

    /**
     * @param callable[] $factories Indexed by command names
     */
    public function __construct(array $factories)
    {
        $this->factories = $factories;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has(string $name): bool
=======
    public function has(string $name)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->factories[$name]);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function get(string $name): Command
=======
    public function get(string $name)
>>>>>>> origin/New-FakeMain
    {
        if (!isset($this->factories[$name])) {
            throw new CommandNotFoundException(sprintf('Command "%s" does not exist.', $name));
        }

        $factory = $this->factories[$name];

        return $factory();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getNames(): array
=======
    public function getNames()
>>>>>>> origin/New-FakeMain
    {
        return array_keys($this->factories);
    }
}
