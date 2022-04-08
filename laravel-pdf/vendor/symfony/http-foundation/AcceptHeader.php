<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpFoundation;

// Help opcache.preload discover always-needed symbols
class_exists(AcceptHeaderItem::class);

/**
 * Represents an Accept-* header.
 *
 * An accept header is compound with a list of items,
 * sorted by descending quality.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class AcceptHeader
{
    /**
     * @var AcceptHeaderItem[]
     */
<<<<<<< HEAD
    private array $items = [];

    private bool $sorted = true;
=======
    private $items = [];

    /**
     * @var bool
     */
    private $sorted = true;
>>>>>>> origin/New-FakeMain

    /**
     * @param AcceptHeaderItem[] $items
     */
    public function __construct(array $items)
    {
        foreach ($items as $item) {
            $this->add($item);
        }
    }

    /**
     * Builds an AcceptHeader instance from a string.
<<<<<<< HEAD
     */
    public static function fromString(?string $headerValue): self
=======
     *
     * @return self
     */
    public static function fromString(?string $headerValue)
>>>>>>> origin/New-FakeMain
    {
        $index = 0;

        $parts = HeaderUtils::split($headerValue ?? '', ',;=');

        return new self(array_map(function ($subParts) use (&$index) {
            $part = array_shift($subParts);
            $attributes = HeaderUtils::combine($subParts);

            $item = new AcceptHeaderItem($part[0], $attributes);
            $item->setIndex($index++);

            return $item;
        }, $parts));
    }

    /**
     * Returns header value's string representation.
<<<<<<< HEAD
     */
    public function __toString(): string
=======
     *
     * @return string
     */
    public function __toString()
>>>>>>> origin/New-FakeMain
    {
        return implode(',', $this->items);
    }

    /**
     * Tests if header has given value.
<<<<<<< HEAD
     */
    public function has(string $value): bool
=======
     *
     * @return bool
     */
    public function has(string $value)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->items[$value]);
    }

    /**
     * Returns given value's item, if exists.
<<<<<<< HEAD
     */
    public function get(string $value): ?AcceptHeaderItem
=======
     *
     * @return AcceptHeaderItem|null
     */
    public function get(string $value)
>>>>>>> origin/New-FakeMain
    {
        return $this->items[$value] ?? $this->items[explode('/', $value)[0].'/*'] ?? $this->items['*/*'] ?? $this->items['*'] ?? null;
    }

    /**
     * Adds an item.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function add(AcceptHeaderItem $item): static
=======
    public function add(AcceptHeaderItem $item)
>>>>>>> origin/New-FakeMain
    {
        $this->items[$item->getValue()] = $item;
        $this->sorted = false;

        return $this;
    }

    /**
     * Returns all items.
     *
     * @return AcceptHeaderItem[]
     */
<<<<<<< HEAD
    public function all(): array
=======
    public function all()
>>>>>>> origin/New-FakeMain
    {
        $this->sort();

        return $this->items;
    }

    /**
     * Filters items on their value using given regex.
<<<<<<< HEAD
     */
    public function filter(string $pattern): self
=======
     *
     * @return self
     */
    public function filter(string $pattern)
>>>>>>> origin/New-FakeMain
    {
        return new self(array_filter($this->items, function (AcceptHeaderItem $item) use ($pattern) {
            return preg_match($pattern, $item->getValue());
        }));
    }

    /**
     * Returns first item.
<<<<<<< HEAD
     */
    public function first(): ?AcceptHeaderItem
=======
     *
     * @return AcceptHeaderItem|null
     */
    public function first()
>>>>>>> origin/New-FakeMain
    {
        $this->sort();

        return !empty($this->items) ? reset($this->items) : null;
    }

    /**
     * Sorts items by descending quality.
     */
    private function sort(): void
    {
        if (!$this->sorted) {
            uasort($this->items, function (AcceptHeaderItem $a, AcceptHeaderItem $b) {
                $qA = $a->getQuality();
                $qB = $b->getQuality();

                if ($qA === $qB) {
                    return $a->getIndex() > $b->getIndex() ? 1 : -1;
                }

                return $qA > $qB ? -1 : 1;
            });

            $this->sorted = true;
        }
    }
}
