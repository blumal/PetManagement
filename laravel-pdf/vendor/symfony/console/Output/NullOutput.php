<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Output;

use Symfony\Component\Console\Formatter\NullOutputFormatter;
use Symfony\Component\Console\Formatter\OutputFormatterInterface;

/**
 * NullOutput suppresses all output.
 *
 *     $output = new NullOutput();
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Tobias Schultze <http://tobion.de>
 */
class NullOutput implements OutputInterface
{
    private $formatter;

    /**
     * {@inheritdoc}
     */
    public function setFormatter(OutputFormatterInterface $formatter)
    {
        // do nothing
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getFormatter(): OutputFormatterInterface
    {
        // to comply with the interface we must return a OutputFormatterInterface
        return $this->formatter ??= new NullOutputFormatter();
=======
    public function getFormatter()
    {
        if ($this->formatter) {
            return $this->formatter;
        }
        // to comply with the interface we must return a OutputFormatterInterface
        return $this->formatter = new NullOutputFormatter();
>>>>>>> origin/New-FakeMain
    }

    /**
     * {@inheritdoc}
     */
    public function setDecorated(bool $decorated)
    {
        // do nothing
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
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function setVerbosity(int $level)
    {
        // do nothing
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
        return self::VERBOSITY_QUIET;
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
        return true;
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
        return false;
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
        return false;
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
        return false;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function writeln(string|iterable $messages, int $options = self::OUTPUT_NORMAL)
=======
    public function writeln($messages, int $options = self::OUTPUT_NORMAL)
>>>>>>> origin/New-FakeMain
    {
        // do nothing
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function write(string|iterable $messages, bool $newline = false, int $options = self::OUTPUT_NORMAL)
=======
    public function write($messages, bool $newline = false, int $options = self::OUTPUT_NORMAL)
>>>>>>> origin/New-FakeMain
    {
        // do nothing
    }
}
