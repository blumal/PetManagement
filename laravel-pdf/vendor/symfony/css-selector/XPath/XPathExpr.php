<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\CssSelector\XPath;

/**
 * XPath expression translator interface.
 *
 * This component is a port of the Python cssselect library,
 * which is copyright Ian Bicking, @see https://github.com/SimonSapin/cssselect.
 *
 * @author Jean-François Simon <jeanfrancois.simon@sensiolabs.com>
 *
 * @internal
 */
class XPathExpr
{
<<<<<<< HEAD
    private string $path;
    private string $element;
    private string $condition;
=======
    private $path;
    private $element;
    private $condition;
>>>>>>> origin/New-FakeMain

    public function __construct(string $path = '', string $element = '*', string $condition = '', bool $starPrefix = false)
    {
        $this->path = $path;
        $this->element = $element;
        $this->condition = $condition;

        if ($starPrefix) {
            $this->addStarPrefix();
        }
    }

    public function getElement(): string
    {
        return $this->element;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addCondition(string $condition): static
=======
    public function addCondition(string $condition): self
>>>>>>> origin/New-FakeMain
    {
        $this->condition = $this->condition ? sprintf('(%s) and (%s)', $this->condition, $condition) : $condition;

        return $this;
    }

    public function getCondition(): string
    {
        return $this->condition;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addNameTest(): static
=======
    public function addNameTest(): self
>>>>>>> origin/New-FakeMain
    {
        if ('*' !== $this->element) {
            $this->addCondition('name() = '.Translator::getXpathLiteral($this->element));
            $this->element = '*';
        }

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function addStarPrefix(): static
=======
    public function addStarPrefix(): self
>>>>>>> origin/New-FakeMain
    {
        $this->path .= '*/';

        return $this;
    }

    /**
     * Joins another XPathExpr with a combiner.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function join(string $combiner, self $expr): static
=======
    public function join(string $combiner, self $expr): self
>>>>>>> origin/New-FakeMain
    {
        $path = $this->__toString().$combiner;

        if ('*/' !== $expr->path) {
            $path .= $expr->path;
        }

        $this->path = $path;
        $this->element = $expr->element;
        $this->condition = $expr->condition;

        return $this;
    }

    public function __toString(): string
    {
        $path = $this->path.$this->element;
        $condition = null === $this->condition || '' === $this->condition ? '' : '['.$this->condition.']';

        return $path.$condition;
    }
}
