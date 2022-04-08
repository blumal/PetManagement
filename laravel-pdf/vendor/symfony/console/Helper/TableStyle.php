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

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Defines the styles for a Table.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Саша Стаменковић <umpirsky@gmail.com>
 * @author Dany Maillard <danymaillard93b@gmail.com>
 */
class TableStyle
{
<<<<<<< HEAD
    private string $paddingChar = ' ';
    private string $horizontalOutsideBorderChar = '-';
    private string $horizontalInsideBorderChar = '-';
    private string $verticalOutsideBorderChar = '|';
    private string $verticalInsideBorderChar = '|';
    private string $crossingChar = '+';
    private string $crossingTopRightChar = '+';
    private string $crossingTopMidChar = '+';
    private string $crossingTopLeftChar = '+';
    private string $crossingMidRightChar = '+';
    private string $crossingBottomRightChar = '+';
    private string $crossingBottomMidChar = '+';
    private string $crossingBottomLeftChar = '+';
    private string $crossingMidLeftChar = '+';
    private string $crossingTopLeftBottomChar = '+';
    private string $crossingTopMidBottomChar = '+';
    private string $crossingTopRightBottomChar = '+';
    private string $headerTitleFormat = '<fg=black;bg=white;options=bold> %s </>';
    private string $footerTitleFormat = '<fg=black;bg=white;options=bold> %s </>';
    private string $cellHeaderFormat = '<info>%s</info>';
    private string $cellRowFormat = '%s';
    private string $cellRowContentFormat = ' %s ';
    private string $borderFormat = '%s';
    private int $padType = \STR_PAD_RIGHT;
=======
    private $paddingChar = ' ';
    private $horizontalOutsideBorderChar = '-';
    private $horizontalInsideBorderChar = '-';
    private $verticalOutsideBorderChar = '|';
    private $verticalInsideBorderChar = '|';
    private $crossingChar = '+';
    private $crossingTopRightChar = '+';
    private $crossingTopMidChar = '+';
    private $crossingTopLeftChar = '+';
    private $crossingMidRightChar = '+';
    private $crossingBottomRightChar = '+';
    private $crossingBottomMidChar = '+';
    private $crossingBottomLeftChar = '+';
    private $crossingMidLeftChar = '+';
    private $crossingTopLeftBottomChar = '+';
    private $crossingTopMidBottomChar = '+';
    private $crossingTopRightBottomChar = '+';
    private $headerTitleFormat = '<fg=black;bg=white;options=bold> %s </>';
    private $footerTitleFormat = '<fg=black;bg=white;options=bold> %s </>';
    private $cellHeaderFormat = '<info>%s</info>';
    private $cellRowFormat = '%s';
    private $cellRowContentFormat = ' %s ';
    private $borderFormat = '%s';
    private $padType = \STR_PAD_RIGHT;
>>>>>>> origin/New-FakeMain

    /**
     * Sets padding character, used for cell padding.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setPaddingChar(string $paddingChar): static
=======
    public function setPaddingChar(string $paddingChar)
>>>>>>> origin/New-FakeMain
    {
        if (!$paddingChar) {
            throw new LogicException('The padding char must not be empty.');
        }

        $this->paddingChar = $paddingChar;

        return $this;
    }

    /**
     * Gets padding character, used for cell padding.
<<<<<<< HEAD
     */
    public function getPaddingChar(): string
=======
     *
     * @return string
     */
    public function getPaddingChar()
>>>>>>> origin/New-FakeMain
    {
        return $this->paddingChar;
    }

    /**
     * Sets horizontal border characters.
     *
     * <code>
     * ╔═══════════════╤══════════════════════════╤══════════════════╗
     * 1 ISBN          2 Title                    │ Author           ║
     * ╠═══════════════╪══════════════════════════╪══════════════════╣
     * ║ 99921-58-10-7 │ Divine Comedy            │ Dante Alighieri  ║
     * ║ 9971-5-0210-0 │ A Tale of Two Cities     │ Charles Dickens  ║
     * ║ 960-425-059-0 │ The Lord of the Rings    │ J. R. R. Tolkien ║
     * ║ 80-902734-1-6 │ And Then There Were None │ Agatha Christie  ║
     * ╚═══════════════╧══════════════════════════╧══════════════════╝
     * </code>
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setHorizontalBorderChars(string $outside, string $inside = null): static
=======
    public function setHorizontalBorderChars(string $outside, string $inside = null): self
>>>>>>> origin/New-FakeMain
    {
        $this->horizontalOutsideBorderChar = $outside;
        $this->horizontalInsideBorderChar = $inside ?? $outside;

        return $this;
    }

    /**
     * Sets vertical border characters.
     *
     * <code>
     * ╔═══════════════╤══════════════════════════╤══════════════════╗
     * ║ ISBN          │ Title                    │ Author           ║
     * ╠═══════1═══════╪══════════════════════════╪══════════════════╣
     * ║ 99921-58-10-7 │ Divine Comedy            │ Dante Alighieri  ║
     * ║ 9971-5-0210-0 │ A Tale of Two Cities     │ Charles Dickens  ║
     * ╟───────2───────┼──────────────────────────┼──────────────────╢
     * ║ 960-425-059-0 │ The Lord of the Rings    │ J. R. R. Tolkien ║
     * ║ 80-902734-1-6 │ And Then There Were None │ Agatha Christie  ║
     * ╚═══════════════╧══════════════════════════╧══════════════════╝
     * </code>
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setVerticalBorderChars(string $outside, string $inside = null): static
=======
    public function setVerticalBorderChars(string $outside, string $inside = null): self
>>>>>>> origin/New-FakeMain
    {
        $this->verticalOutsideBorderChar = $outside;
        $this->verticalInsideBorderChar = $inside ?? $outside;

        return $this;
    }

    /**
     * Gets border characters.
     *
     * @internal
     */
    public function getBorderChars(): array
    {
        return [
            $this->horizontalOutsideBorderChar,
            $this->verticalOutsideBorderChar,
            $this->horizontalInsideBorderChar,
            $this->verticalInsideBorderChar,
        ];
    }

    /**
     * Sets crossing characters.
     *
     * Example:
     * <code>
     * 1═══════════════2══════════════════════════2══════════════════3
     * ║ ISBN          │ Title                    │ Author           ║
     * 8'══════════════0'═════════════════════════0'═════════════════4'
     * ║ 99921-58-10-7 │ Divine Comedy            │ Dante Alighieri  ║
     * ║ 9971-5-0210-0 │ A Tale of Two Cities     │ Charles Dickens  ║
     * 8───────────────0──────────────────────────0──────────────────4
     * ║ 960-425-059-0 │ The Lord of the Rings    │ J. R. R. Tolkien ║
     * ║ 80-902734-1-6 │ And Then There Were None │ Agatha Christie  ║
     * 7═══════════════6══════════════════════════6══════════════════5
     * </code>
     *
     * @param string      $cross          Crossing char (see #0 of example)
     * @param string      $topLeft        Top left char (see #1 of example)
     * @param string      $topMid         Top mid char (see #2 of example)
     * @param string      $topRight       Top right char (see #3 of example)
     * @param string      $midRight       Mid right char (see #4 of example)
     * @param string      $bottomRight    Bottom right char (see #5 of example)
     * @param string      $bottomMid      Bottom mid char (see #6 of example)
     * @param string      $bottomLeft     Bottom left char (see #7 of example)
     * @param string      $midLeft        Mid left char (see #8 of example)
     * @param string|null $topLeftBottom  Top left bottom char (see #8' of example), equals to $midLeft if null
     * @param string|null $topMidBottom   Top mid bottom char (see #0' of example), equals to $cross if null
     * @param string|null $topRightBottom Top right bottom char (see #4' of example), equals to $midRight if null
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setCrossingChars(string $cross, string $topLeft, string $topMid, string $topRight, string $midRight, string $bottomRight, string $bottomMid, string $bottomLeft, string $midLeft, string $topLeftBottom = null, string $topMidBottom = null, string $topRightBottom = null): static
=======
    public function setCrossingChars(string $cross, string $topLeft, string $topMid, string $topRight, string $midRight, string $bottomRight, string $bottomMid, string $bottomLeft, string $midLeft, string $topLeftBottom = null, string $topMidBottom = null, string $topRightBottom = null): self
>>>>>>> origin/New-FakeMain
    {
        $this->crossingChar = $cross;
        $this->crossingTopLeftChar = $topLeft;
        $this->crossingTopMidChar = $topMid;
        $this->crossingTopRightChar = $topRight;
        $this->crossingMidRightChar = $midRight;
        $this->crossingBottomRightChar = $bottomRight;
        $this->crossingBottomMidChar = $bottomMid;
        $this->crossingBottomLeftChar = $bottomLeft;
        $this->crossingMidLeftChar = $midLeft;
        $this->crossingTopLeftBottomChar = $topLeftBottom ?? $midLeft;
        $this->crossingTopMidBottomChar = $topMidBottom ?? $cross;
        $this->crossingTopRightBottomChar = $topRightBottom ?? $midRight;

        return $this;
    }

    /**
     * Sets default crossing character used for each cross.
     *
     * @see {@link setCrossingChars()} for setting each crossing individually.
     */
    public function setDefaultCrossingChar(string $char): self
    {
        return $this->setCrossingChars($char, $char, $char, $char, $char, $char, $char, $char, $char);
    }

    /**
     * Gets crossing character.
<<<<<<< HEAD
     */
    public function getCrossingChar(): string
=======
     *
     * @return string
     */
    public function getCrossingChar()
>>>>>>> origin/New-FakeMain
    {
        return $this->crossingChar;
    }

    /**
     * Gets crossing characters.
     *
     * @internal
     */
    public function getCrossingChars(): array
    {
        return [
            $this->crossingChar,
            $this->crossingTopLeftChar,
            $this->crossingTopMidChar,
            $this->crossingTopRightChar,
            $this->crossingMidRightChar,
            $this->crossingBottomRightChar,
            $this->crossingBottomMidChar,
            $this->crossingBottomLeftChar,
            $this->crossingMidLeftChar,
            $this->crossingTopLeftBottomChar,
            $this->crossingTopMidBottomChar,
            $this->crossingTopRightBottomChar,
        ];
    }

    /**
     * Sets header cell format.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setCellHeaderFormat(string $cellHeaderFormat): static
=======
    public function setCellHeaderFormat(string $cellHeaderFormat)
>>>>>>> origin/New-FakeMain
    {
        $this->cellHeaderFormat = $cellHeaderFormat;

        return $this;
    }

    /**
     * Gets header cell format.
<<<<<<< HEAD
     */
    public function getCellHeaderFormat(): string
=======
     *
     * @return string
     */
    public function getCellHeaderFormat()
>>>>>>> origin/New-FakeMain
    {
        return $this->cellHeaderFormat;
    }

    /**
     * Sets row cell format.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setCellRowFormat(string $cellRowFormat): static
=======
    public function setCellRowFormat(string $cellRowFormat)
>>>>>>> origin/New-FakeMain
    {
        $this->cellRowFormat = $cellRowFormat;

        return $this;
    }

    /**
     * Gets row cell format.
<<<<<<< HEAD
     */
    public function getCellRowFormat(): string
=======
     *
     * @return string
     */
    public function getCellRowFormat()
>>>>>>> origin/New-FakeMain
    {
        return $this->cellRowFormat;
    }

    /**
     * Sets row cell content format.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setCellRowContentFormat(string $cellRowContentFormat): static
=======
    public function setCellRowContentFormat(string $cellRowContentFormat)
>>>>>>> origin/New-FakeMain
    {
        $this->cellRowContentFormat = $cellRowContentFormat;

        return $this;
    }

    /**
     * Gets row cell content format.
<<<<<<< HEAD
     */
    public function getCellRowContentFormat(): string
=======
     *
     * @return string
     */
    public function getCellRowContentFormat()
>>>>>>> origin/New-FakeMain
    {
        return $this->cellRowContentFormat;
    }

    /**
     * Sets table border format.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setBorderFormat(string $borderFormat): static
=======
    public function setBorderFormat(string $borderFormat)
>>>>>>> origin/New-FakeMain
    {
        $this->borderFormat = $borderFormat;

        return $this;
    }

    /**
     * Gets table border format.
<<<<<<< HEAD
     */
    public function getBorderFormat(): string
=======
     *
     * @return string
     */
    public function getBorderFormat()
>>>>>>> origin/New-FakeMain
    {
        return $this->borderFormat;
    }

    /**
     * Sets cell padding type.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setPadType(int $padType): static
=======
    public function setPadType(int $padType)
>>>>>>> origin/New-FakeMain
    {
        if (!\in_array($padType, [\STR_PAD_LEFT, \STR_PAD_RIGHT, \STR_PAD_BOTH], true)) {
            throw new InvalidArgumentException('Invalid padding type. Expected one of (STR_PAD_LEFT, STR_PAD_RIGHT, STR_PAD_BOTH).');
        }

        $this->padType = $padType;

        return $this;
    }

    /**
     * Gets cell padding type.
<<<<<<< HEAD
     */
    public function getPadType(): int
=======
     *
     * @return int
     */
    public function getPadType()
>>>>>>> origin/New-FakeMain
    {
        return $this->padType;
    }

    public function getHeaderTitleFormat(): string
    {
        return $this->headerTitleFormat;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function setHeaderTitleFormat(string $format): static
=======
    public function setHeaderTitleFormat(string $format): self
>>>>>>> origin/New-FakeMain
    {
        $this->headerTitleFormat = $format;

        return $this;
    }

    public function getFooterTitleFormat(): string
    {
        return $this->footerTitleFormat;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function setFooterTitleFormat(string $format): static
=======
    public function setFooterTitleFormat(string $format): self
>>>>>>> origin/New-FakeMain
    {
        $this->footerTitleFormat = $format;

        return $this;
    }
}
