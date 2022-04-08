<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation\Session\Flash;

use Symfony\Component\HttpFoundation\Session\SessionBagInterface;

/**
 * FlashBagInterface.
 *
 * @author Drak <drak@zikula.org>
 */
interface FlashBagInterface extends SessionBagInterface
{
    /**
     * Adds a flash message for the given type.
<<<<<<< HEAD
     */
    public function add(string $type, mixed $message);

    /**
     * Registers one or more messages for a given type.
     */
    public function set(string $type, string|array $messages);
=======
     *
     * @param mixed $message
     */
    public function add(string $type, $message);

    /**
     * Registers one or more messages for a given type.
     *
     * @param string|array $messages
     */
    public function set(string $type, $messages);
>>>>>>> origin/New-FakeMain

    /**
     * Gets flash messages for a given type.
     *
     * @param string $type    Message category type
     * @param array  $default Default value if $type does not exist
<<<<<<< HEAD
     */
    public function peek(string $type, array $default = []): array;

    /**
     * Gets all flash messages.
     */
    public function peekAll(): array;
=======
     *
     * @return array
     */
    public function peek(string $type, array $default = []);

    /**
     * Gets all flash messages.
     *
     * @return array
     */
    public function peekAll();
>>>>>>> origin/New-FakeMain

    /**
     * Gets and clears flash from the stack.
     *
     * @param array $default Default value if $type does not exist
<<<<<<< HEAD
     */
    public function get(string $type, array $default = []): array;

    /**
     * Gets and clears flashes from the stack.
     */
    public function all(): array;
=======
     *
     * @return array
     */
    public function get(string $type, array $default = []);

    /**
     * Gets and clears flashes from the stack.
     *
     * @return array
     */
    public function all();
>>>>>>> origin/New-FakeMain

    /**
     * Sets all flash messages.
     */
    public function setAll(array $messages);

    /**
     * Has flash messages for a given type?
<<<<<<< HEAD
     */
    public function has(string $type): bool;

    /**
     * Returns a list of all defined types.
     */
    public function keys(): array;
=======
     *
     * @return bool
     */
    public function has(string $type);

    /**
     * Returns a list of all defined types.
     *
     * @return array
     */
    public function keys();
>>>>>>> origin/New-FakeMain
}
