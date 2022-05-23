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

use Symfony\Component\Console\Formatter\OutputFormatter;

/**
 * The Formatter class provides helpers to format messages.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class FormatterHelper extends Helper
{
    /**
     * Formats a message within a section.
<<<<<<< HEAD
     */
    public function formatSection(string $section, string $message, string $style = 'info'): string
=======
     *
     * @return string
     */
    public function formatSection(string $section, string $message, string $style = 'info')
>>>>>>> origin/New-FakeMain
    {
        return sprintf('<%s>[%s]</%s> %s', $style, $section, $style, $message);
    }

    /**
     * Formats a message as a block of text.
<<<<<<< HEAD
     */
    public function formatBlock(string|array $messages, string $style, bool $large = false): string
=======
     *
     * @param string|array $messages The message to write in the block
     *
     * @return string
     */
    public function formatBlock($messages, string $style, bool $large = false)
>>>>>>> origin/New-FakeMain
    {
        if (!\is_array($messages)) {
            $messages = [$messages];
        }

        $len = 0;
        $lines = [];
        foreach ($messages as $message) {
            $message = OutputFormatter::escape($message);
            $lines[] = sprintf($large ? '  %s  ' : ' %s ', $message);
            $len = max(self::width($message) + ($large ? 4 : 2), $len);
        }

        $messages = $large ? [str_repeat(' ', $len)] : [];
        for ($i = 0; isset($lines[$i]); ++$i) {
            $messages[] = $lines[$i].str_repeat(' ', $len - self::width($lines[$i]));
        }
        if ($large) {
            $messages[] = str_repeat(' ', $len);
        }

        for ($i = 0; isset($messages[$i]); ++$i) {
            $messages[$i] = sprintf('<%s>%s</%s>', $style, $messages[$i], $style);
        }

        return implode("\n", $messages);
    }

    /**
     * Truncates a message to the given length.
<<<<<<< HEAD
     */
    public function truncate(string $message, int $length, string $suffix = '...'): string
=======
     *
     * @return string
     */
    public function truncate(string $message, int $length, string $suffix = '...')
>>>>>>> origin/New-FakeMain
    {
        $computedLength = $length - self::width($suffix);

        if ($computedLength > self::width($message)) {
            return $message;
        }

        return self::substr($message, 0, $length).$suffix;
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
        return 'formatter';
    }
}
