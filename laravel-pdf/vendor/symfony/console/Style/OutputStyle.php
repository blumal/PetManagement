<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Style;

use Symfony\Component\Console\Formatter\OutputFormatterInterface;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Output\ConsoleOutputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Decorates output to add console style guide helpers.
 *
 * @author Kevin Bond <kevinbond@gmail.com>
 */
abstract class OutputStyle implements OutputInterface, StyleInterface
{
    private $output;

    public function __construct(OutputInterface $output)
    {
        $this->output = $output;
    }

    /**
     * {@inheritdoc}
     */
    public function newLine(int $count = 1)
    {
        $this->output->write(str_repeat(\PHP_EOL, $count));
    }

<<<<<<< HEAD
    public function createProgressBar(int $max = 0): ProgressBar
=======
    /**
     * @return ProgressBar
     */
    public function createProgressBar(int $max = 0)
>>>>>>> origin/New-FakeMain
    {
        return new ProgressBar($this->output, $max);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function write(string|iterable $messages, bool $newline = false, int $type = self::OUTPUT_NORMAL)
=======
    public function write($messages, bool $newline = false, int $type = self::OUTPUT_NORMAL)
>>>>>>> origin/New-FakeMain
    {
        $this->output->write($messages, $newline, $type);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function writeln(string|iterable $messages, int $type = self::OUTPUT_NORMAL)
=======
    public function writeln($messages, int $type = self::OUTPUT_NORMAL)
>>>>>>> origin/New-FakeMain
    {
        $this->output->writeln($messages, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function setVerbosity(int $level)
    {
        $this->output->setVerbosity($level);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getVerbosity(): int
=======
    public function getVerbosity()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->getVerbosity();
    }

    /**
     * {@inheritdoc}
     */
    public function setDecorated(bool $decorated)
    {
        $this->output->setDecorated($decorated);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isDecorated(): bool
=======
    public function isDecorated()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->isDecorated();
    }

    /**
     * {@inheritdoc}
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        $this->output->setFormatter($formatter);
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getFormatter(): OutputFormatterInterface
=======
    public function getFormatter()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->getFormatter();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isQuiet(): bool
=======
    public function isQuiet()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->isQuiet();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isVerbose(): bool
=======
    public function isVerbose()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->isVerbose();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isVeryVerbose(): bool
=======
    public function isVeryVerbose()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->isVeryVerbose();
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isDebug(): bool
=======
    public function isDebug()
>>>>>>> origin/New-FakeMain
    {
        return $this->output->isDebug();
    }

    protected function getErrorOutput()
    {
        if (!$this->output instanceof ConsoleOutputInterface) {
            return $this->output;
        }

        return $this->output->getErrorOutput();
    }
}
