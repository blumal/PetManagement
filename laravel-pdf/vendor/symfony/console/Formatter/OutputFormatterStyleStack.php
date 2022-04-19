<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Formatter;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Contracts\Service\ResetInterface;

/**
 * @author Jean-François Simon <contact@jfsimon.fr>
 */
class OutputFormatterStyleStack implements ResetInterface
{
    /**
     * @var OutputFormatterStyleInterface[]
     */
<<<<<<< HEAD
    private array $styles = [];
=======
    private $styles;
>>>>>>> origin/New-FakeMain

    private $emptyStyle;

    public function __construct(OutputFormatterStyleInterface $emptyStyle = null)
    {
        $this->emptyStyle = $emptyStyle ?? new OutputFormatterStyle();
        $this->reset();
    }

    /**
     * Resets stack (ie. empty internal arrays).
     */
    public function reset()
    {
        $this->styles = [];
    }

    /**
     * Pushes a style in the stack.
     */
    public function push(OutputFormatterStyleInterface $style)
    {
        $this->styles[] = $style;
    }

    /**
     * Pops a style from the stack.
     *
<<<<<<< HEAD
     * @throws InvalidArgumentException When style tags incorrectly nested
     */
    public function pop(OutputFormatterStyleInterface $style = null): OutputFormatterStyleInterface
=======
     * @return OutputFormatterStyleInterface
     *
     * @throws InvalidArgumentException When style tags incorrectly nested
     */
    public function pop(OutputFormatterStyleInterface $style = null)
>>>>>>> origin/New-FakeMain
    {
        if (empty($this->styles)) {
            return $this->emptyStyle;
        }

        if (null === $style) {
            return array_pop($this->styles);
        }

        foreach (array_reverse($this->styles, true) as $index => $stackedStyle) {
            if ($style->apply('') === $stackedStyle->apply('')) {
                $this->styles = \array_slice($this->styles, 0, $index);

                return $stackedStyle;
            }
        }

        throw new InvalidArgumentException('Incorrectly nested style tag found.');
    }

    /**
     * Computes current style with stacks top codes.
<<<<<<< HEAD
     */
    public function getCurrent(): OutputFormatterStyle
=======
     *
     * @return OutputFormatterStyle
     */
    public function getCurrent()
>>>>>>> origin/New-FakeMain
    {
        if (empty($this->styles)) {
            return $this->emptyStyle;
        }

        return $this->styles[\count($this->styles) - 1];
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function setEmptyStyle(OutputFormatterStyleInterface $emptyStyle): static
=======
    public function setEmptyStyle(OutputFormatterStyleInterface $emptyStyle)
>>>>>>> origin/New-FakeMain
    {
        $this->emptyStyle = $emptyStyle;

        return $this;
    }

<<<<<<< HEAD
    public function getEmptyStyle(): OutputFormatterStyleInterface
=======
    /**
     * @return OutputFormatterStyleInterface
     */
    public function getEmptyStyle()
>>>>>>> origin/New-FakeMain
    {
        return $this->emptyStyle;
    }
}
