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

use Psr\Container\ContainerInterface;
<<<<<<< HEAD
use Symfony\Component\Console\Command\Command;
=======
>>>>>>> origin/New-FakeMain
use Symfony\Component\Console\Exception\CommandNotFoundException;

/**
 * Loads commands from a PSR-11 container.
 *
 * @author Robin Chalas <robin.chalas@gmail.com>
 */
class ContainerCommandLoader implements CommandLoaderInterface
{
    private $container;
<<<<<<< HEAD
    private array $commandMap;
=======
    private $commandMap;
>>>>>>> origin/New-FakeMain

    /**
     * @param array $commandMap An array with command names as keys and service ids as values
     */
    public function __construct(ContainerInterface $container, array $commandMap)
    {
        $this->container = $container;
        $this->commandMap = $commandMap;
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
        if (!$this->has($name)) {
            throw new CommandNotFoundException(sprintf('Command "%s" does not exist.', $name));
        }

        return $this->container->get($this->commandMap[$name]);
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
        return isset($this->commandMap[$name]) && $this->container->has($this->commandMap[$name]);
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
        return array_keys($this->commandMap);
    }
}
