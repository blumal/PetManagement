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

/**
 * Represents an Accept-* header item.
 *
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class AcceptHeaderItem
{
<<<<<<< HEAD
    private string $value;
    private float $quality = 1.0;
    private int $index = 0;
    private array $attributes = [];
=======
    private $value;
    private $quality = 1.0;
    private $index = 0;
    private $attributes = [];
>>>>>>> origin/New-FakeMain

    public function __construct(string $value, array $attributes = [])
    {
        $this->value = $value;
        foreach ($attributes as $name => $value) {
            $this->setAttribute($name, $value);
        }
    }

    /**
     * Builds an AcceptHeaderInstance instance from a string.
<<<<<<< HEAD
     */
    public static function fromString(?string $itemValue): self
=======
     *
     * @return self
     */
    public static function fromString(?string $itemValue)
>>>>>>> origin/New-FakeMain
    {
        $parts = HeaderUtils::split($itemValue ?? '', ';=');

        $part = array_shift($parts);
        $attributes = HeaderUtils::combine($parts);

        return new self($part[0], $attributes);
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
        $string = $this->value.($this->quality < 1 ? ';q='.$this->quality : '');
        if (\count($this->attributes) > 0) {
            $string .= '; '.HeaderUtils::toString($this->attributes, ';');
        }

        return $string;
    }

    /**
     * Set the item value.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setValue(string $value): static
=======
    public function setValue(string $value)
>>>>>>> origin/New-FakeMain
    {
        $this->value = $value;

        return $this;
    }

    /**
     * Returns the item value.
<<<<<<< HEAD
     */
    public function getValue(): string
=======
     *
     * @return string
     */
    public function getValue()
>>>>>>> origin/New-FakeMain
    {
        return $this->value;
    }

    /**
     * Set the item quality.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setQuality(float $quality): static
=======
    public function setQuality(float $quality)
>>>>>>> origin/New-FakeMain
    {
        $this->quality = $quality;

        return $this;
    }

    /**
     * Returns the item quality.
<<<<<<< HEAD
     */
    public function getQuality(): float
=======
     *
     * @return float
     */
    public function getQuality()
>>>>>>> origin/New-FakeMain
    {
        return $this->quality;
    }

    /**
     * Set the item index.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setIndex(int $index): static
=======
    public function setIndex(int $index)
>>>>>>> origin/New-FakeMain
    {
        $this->index = $index;

        return $this;
    }

    /**
     * Returns the item index.
<<<<<<< HEAD
     */
    public function getIndex(): int
=======
     *
     * @return int
     */
    public function getIndex()
>>>>>>> origin/New-FakeMain
    {
        return $this->index;
    }

    /**
     * Tests if an attribute exists.
<<<<<<< HEAD
     */
    public function hasAttribute(string $name): bool
=======
     *
     * @return bool
     */
    public function hasAttribute(string $name)
>>>>>>> origin/New-FakeMain
    {
        return isset($this->attributes[$name]);
    }

    /**
     * Returns an attribute by its name.
<<<<<<< HEAD
     */
    public function getAttribute(string $name, mixed $default = null): mixed
=======
     *
     * @param mixed $default
     *
     * @return mixed
     */
    public function getAttribute(string $name, $default = null)
>>>>>>> origin/New-FakeMain
    {
        return $this->attributes[$name] ?? $default;
    }

    /**
     * Returns all attributes.
<<<<<<< HEAD
     */
    public function getAttributes(): array
=======
     *
     * @return array
     */
    public function getAttributes()
>>>>>>> origin/New-FakeMain
    {
        return $this->attributes;
    }

    /**
     * Set an attribute.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setAttribute(string $name, string $value): static
=======
    public function setAttribute(string $name, string $value)
>>>>>>> origin/New-FakeMain
    {
        if ('q' === $name) {
            $this->quality = (float) $value;
        } else {
            $this->attributes[$name] = $value;
        }

        return $this;
    }
}
