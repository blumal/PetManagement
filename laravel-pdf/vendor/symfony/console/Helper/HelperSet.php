<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Helper;

<<<<<<< HEAD
=======
use Symfony\Component\Console\Command\Command;
>>>>>>> origin/New-FakeMain
use Symfony\Component\Console\Exception\InvalidArgumentException;

/**
 * HelperSet represents a set of helpers to be used with a command.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @implements \IteratorAggregate<string, Helper>
 */
class HelperSet implements \IteratorAggregate
{
    /** @var array<string, Helper> */
<<<<<<< HEAD
    private array $helpers = [];
=======
    private $helpers = [];
    private $command;
>>>>>>> origin/New-FakeMain

    /**
     * @param Helper[] $helpers An array of helper
     */
    public function __construct(array $helpers = [])
    {
        foreach ($helpers as $alias => $helper) {
            $this->set($helper, \is_int($alias) ? null : $alias);
        }
    }

    public function set(HelperInterface $helper, string $alias = null)
    {
        $this->helpers[$helper->getName()] = $helper;
        if (null !== $alias) {
            $this->helpers[$alias] = $helper;
        }

        $helper->setHelperSet($this);
    }

    /**
     * Returns true if the helper if defined.
<<<<<<< HEAD
     */
    public function has(string $name): bool
=======
     *
     * @return bool
     */
    public function has(string $name)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->helpers[$name]);
    }

    /**
     * Gets a helper value.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException if the helper is not defined
     */
    public function get(string $name): HelperInterface
=======
     * @return HelperInterface
     *
     * @throws InvalidArgumentException if the helper is not defined
     */
    public function get(string $name)
>>>>>>> origin/New-FakeMain
    {
        if (!$this->has($name)) {
            throw new InvalidArgumentException(sprintf('The helper "%s" is not defined.', $name));
        }

        return $this->helpers[$name];
    }

<<<<<<< HEAD
    public function getIterator(): \Traversable
=======
    /**
     * @deprecated since Symfony 5.4
     */
    public function setCommand(Command $command = null)
    {
        trigger_deprecation('symfony/console', '5.4', 'Method "%s()" is deprecated.', __METHOD__);

        $this->command = $command;
    }

    /**
     * Gets the command associated with this helper set.
     *
     * @return Command
     *
     * @deprecated since Symfony 5.4
     */
    public function getCommand()
    {
        trigger_deprecation('symfony/console', '5.4', 'Method "%s()" is deprecated.', __METHOD__);

        return $this->command;
    }

    /**
     * @return \Traversable<string, Helper>
     */
    #[\ReturnTypeWillChange]
    public function getIterator()
>>>>>>> origin/New-FakeMain
    {
        return new \ArrayIterator($this->helpers);
    }
}
