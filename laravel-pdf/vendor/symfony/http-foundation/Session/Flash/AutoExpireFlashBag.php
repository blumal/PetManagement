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

/**
 * AutoExpireFlashBag flash message container.
 *
 * @author Drak <drak@zikula.org>
 */
class AutoExpireFlashBag implements FlashBagInterface
{
<<<<<<< HEAD
    private string $name = 'flashes';
    private array $flashes = ['display' => [], 'new' => []];
    private string $storageKey;
=======
    private $name = 'flashes';
    private $flashes = ['display' => [], 'new' => []];
    private $storageKey;
>>>>>>> origin/New-FakeMain

    /**
     * @param string $storageKey The key used to store flashes in the session
     */
    public function __construct(string $storageKey = '_symfony_flashes')
    {
        $this->storageKey = $storageKey;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getName(): string
=======
    public function getName()
>>>>>>> origin/New-FakeMain
    {
        return $this->name;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function initialize(array &$flashes)
    {
        $this->flashes = &$flashes;

        // The logic: messages from the last request will be stored in new, so we move them to previous
        // This request we will show what is in 'display'.  What is placed into 'new' this time round will
        // be moved to display next time round.
        $this->flashes['display'] = \array_key_exists('new', $this->flashes) ? $this->flashes['new'] : [];
        $this->flashes['new'] = [];
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function add(string $type, mixed $message)
=======
    public function add(string $type, $message)
>>>>>>> origin/New-FakeMain
    {
        $this->flashes['new'][$type][] = $message;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function peek(string $type, array $default = []): array
=======
    public function peek(string $type, array $default = [])
>>>>>>> origin/New-FakeMain
    {
        return $this->has($type) ? $this->flashes['display'][$type] : $default;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function peekAll(): array
=======
    public function peekAll()
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists('display', $this->flashes) ? $this->flashes['display'] : [];
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function get(string $type, array $default = []): array
=======
    public function get(string $type, array $default = [])
>>>>>>> origin/New-FakeMain
    {
        $return = $default;

        if (!$this->has($type)) {
            return $return;
        }

        if (isset($this->flashes['display'][$type])) {
            $return = $this->flashes['display'][$type];
            unset($this->flashes['display'][$type]);
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function all(): array
=======
    public function all()
>>>>>>> origin/New-FakeMain
    {
        $return = $this->flashes['display'];
        $this->flashes['display'] = [];

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function setAll(array $messages)
    {
        $this->flashes['new'] = $messages;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function set(string $type, string|array $messages)
=======
    public function set(string $type, $messages)
>>>>>>> origin/New-FakeMain
    {
        $this->flashes['new'][$type] = (array) $messages;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function has(string $type): bool
=======
    public function has(string $type)
>>>>>>> origin/New-FakeMain
    {
        return \array_key_exists($type, $this->flashes['display']) && $this->flashes['display'][$type];
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function keys(): array
=======
    public function keys()
>>>>>>> origin/New-FakeMain
    {
        return array_keys($this->flashes['display']);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getStorageKey(): string
=======
    public function getStorageKey()
>>>>>>> origin/New-FakeMain
    {
        return $this->storageKey;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function clear(): mixed
=======
    public function clear()
>>>>>>> origin/New-FakeMain
    {
        return $this->all();
    }
}
