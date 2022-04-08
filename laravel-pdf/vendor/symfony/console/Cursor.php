<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console;

use Symfony\Component\Console\Output\OutputInterface;

/**
 * @author Pierre du Plessis <pdples@gmail.com>
 */
final class Cursor
{
    private $output;
    private $input;

    /**
     * @param resource|null $input
     */
    public function __construct(OutputInterface $output, $input = null)
    {
        $this->output = $output;
        $this->input = $input ?? (\defined('STDIN') ? \STDIN : fopen('php://input', 'r+'));
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveUp(int $lines = 1): static
=======
    public function moveUp(int $lines = 1): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%dA", $lines));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveDown(int $lines = 1): static
=======
    public function moveDown(int $lines = 1): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%dB", $lines));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveRight(int $columns = 1): static
=======
    public function moveRight(int $columns = 1): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%dC", $columns));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveLeft(int $columns = 1): static
=======
    public function moveLeft(int $columns = 1): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%dD", $columns));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveToColumn(int $column): static
=======
    public function moveToColumn(int $column): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%dG", $column));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function moveToPosition(int $column, int $row): static
=======
    public function moveToPosition(int $column, int $row): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write(sprintf("\x1b[%d;%dH", $row + 1, $column));

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function savePosition(): static
=======
    public function savePosition(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b7");

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function restorePosition(): static
=======
    public function restorePosition(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b8");

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function hide(): static
=======
    public function hide(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b[?25l");

        return $this;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function show(): static
=======
    public function show(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b[?25h\x1b[?0c");

        return $this;
    }

    /**
     * Clears all the output from the current line.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function clearLine(): static
=======
    public function clearLine(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b[2K");

        return $this;
    }

    /**
     * Clears all the output from the current line after the current position.
     */
    public function clearLineAfter(): self
    {
        $this->output->write("\x1b[K");

        return $this;
    }

    /**
     * Clears all the output from the cursors' current position to the end of the screen.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function clearOutput(): static
=======
    public function clearOutput(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b[0J");

        return $this;
    }

    /**
     * Clears the entire screen.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function clearScreen(): static
=======
    public function clearScreen(): self
>>>>>>> origin/New-FakeMain
    {
        $this->output->write("\x1b[2J");

        return $this;
    }

    /**
     * Returns the current cursor position as x,y coordinates.
     */
    public function getCurrentPosition(): array
    {
        static $isTtySupported;

        if (null === $isTtySupported && \function_exists('proc_open')) {
            $isTtySupported = (bool) @proc_open('echo 1 >/dev/null', [['file', '/dev/tty', 'r'], ['file', '/dev/tty', 'w'], ['file', '/dev/tty', 'w']], $pipes);
        }

        if (!$isTtySupported) {
            return [1, 1];
        }

        $sttyMode = shell_exec('stty -g');
        shell_exec('stty -icanon -echo');

        @fwrite($this->input, "\033[6n");

        $code = trim(fread($this->input, 1024));

        shell_exec(sprintf('stty %s', $sttyMode));

        sscanf($code, "\033[%d;%dR", $row, $col);

        return [$col, $row];
    }
}
