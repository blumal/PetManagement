<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Question;

use Symfony\Component\Console\Exception\InvalidArgumentException;
use Symfony\Component\Console\Exception\LogicException;

/**
 * Represents a Question.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Question
{
<<<<<<< HEAD
    private string $question;
    private ?int $attempts = null;
    private bool $hidden = false;
    private bool $hiddenFallback = true;
    private ?\Closure $autocompleterCallback = null;
    private ?\Closure $validator = null;
    private string|int|bool|null|float $default;
    private ?\Closure $normalizer = null;
    private bool $trimmable = true;
    private bool $multiline = false;
=======
    private $question;
    private $attempts;
    private $hidden = false;
    private $hiddenFallback = true;
    private $autocompleterCallback;
    private $validator;
    private $default;
    private $normalizer;
    private $trimmable = true;
    private $multiline = false;
>>>>>>> origin/New-FakeMain

    /**
     * @param string                     $question The question to ask to the user
     * @param string|bool|int|float|null $default  The default answer to return if the user enters nothing
     */
<<<<<<< HEAD
    public function __construct(string $question, string|bool|int|float $default = null)
=======
    public function __construct(string $question, $default = null)
>>>>>>> origin/New-FakeMain
    {
        $this->question = $question;
        $this->default = $default;
    }

    /**
     * Returns the question.
<<<<<<< HEAD
     */
    public function getQuestion(): string
=======
     *
     * @return string
     */
    public function getQuestion()
>>>>>>> origin/New-FakeMain
    {
        return $this->question;
    }

    /**
     * Returns the default answer.
<<<<<<< HEAD
     */
    public function getDefault(): string|bool|int|float|null
=======
     *
     * @return string|bool|int|float|null
     */
    public function getDefault()
>>>>>>> origin/New-FakeMain
    {
        return $this->default;
    }

    /**
     * Returns whether the user response accepts newline characters.
     */
    public function isMultiline(): bool
    {
        return $this->multiline;
    }

    /**
     * Sets whether the user response should accept newline characters.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setMultiline(bool $multiline): static
=======
    public function setMultiline(bool $multiline): self
>>>>>>> origin/New-FakeMain
    {
        $this->multiline = $multiline;

        return $this;
    }

    /**
     * Returns whether the user response must be hidden.
<<<<<<< HEAD
     */
    public function isHidden(): bool
=======
     *
     * @return bool
     */
    public function isHidden()
>>>>>>> origin/New-FakeMain
    {
        return $this->hidden;
    }

    /**
     * Sets whether the user response must be hidden or not.
     *
     * @return $this
     *
     * @throws LogicException In case the autocompleter is also used
     */
<<<<<<< HEAD
    public function setHidden(bool $hidden): static
=======
    public function setHidden(bool $hidden)
>>>>>>> origin/New-FakeMain
    {
        if ($this->autocompleterCallback) {
            throw new LogicException('A hidden question cannot use the autocompleter.');
        }

        $this->hidden = $hidden;

        return $this;
    }

    /**
     * In case the response cannot be hidden, whether to fallback on non-hidden question or not.
<<<<<<< HEAD
     */
    public function isHiddenFallback(): bool
=======
     *
     * @return bool
     */
    public function isHiddenFallback()
>>>>>>> origin/New-FakeMain
    {
        return $this->hiddenFallback;
    }

    /**
     * Sets whether to fallback on non-hidden question if the response cannot be hidden.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setHiddenFallback(bool $fallback): static
=======
    public function setHiddenFallback(bool $fallback)
>>>>>>> origin/New-FakeMain
    {
        $this->hiddenFallback = $fallback;

        return $this;
    }

    /**
     * Gets values for the autocompleter.
<<<<<<< HEAD
     */
    public function getAutocompleterValues(): ?iterable
=======
     *
     * @return iterable|null
     */
    public function getAutocompleterValues()
>>>>>>> origin/New-FakeMain
    {
        $callback = $this->getAutocompleterCallback();

        return $callback ? $callback('') : null;
    }

    /**
     * Sets values for the autocompleter.
     *
     * @return $this
     *
     * @throws LogicException
     */
<<<<<<< HEAD
    public function setAutocompleterValues(?iterable $values): static
=======
    public function setAutocompleterValues(?iterable $values)
>>>>>>> origin/New-FakeMain
    {
        if (\is_array($values)) {
            $values = $this->isAssoc($values) ? array_merge(array_keys($values), array_values($values)) : array_values($values);

            $callback = static function () use ($values) {
                return $values;
            };
        } elseif ($values instanceof \Traversable) {
            $valueCache = null;
            $callback = static function () use ($values, &$valueCache) {
                return $valueCache ?? $valueCache = iterator_to_array($values, false);
            };
        } else {
            $callback = null;
        }

        return $this->setAutocompleterCallback($callback);
    }

    /**
     * Gets the callback function used for the autocompleter.
     */
    public function getAutocompleterCallback(): ?callable
    {
        return $this->autocompleterCallback;
    }

    /**
     * Sets the callback function used for the autocompleter.
     *
     * The callback is passed the user input as argument and should return an iterable of corresponding suggestions.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setAutocompleterCallback(callable $callback = null): static
=======
    public function setAutocompleterCallback(callable $callback = null): self
>>>>>>> origin/New-FakeMain
    {
        if ($this->hidden && null !== $callback) {
            throw new LogicException('A hidden question cannot use the autocompleter.');
        }

<<<<<<< HEAD
        $this->autocompleterCallback = null === $callback || $callback instanceof \Closure ? $callback : \Closure::fromCallable($callback);
=======
        $this->autocompleterCallback = $callback;
>>>>>>> origin/New-FakeMain

        return $this;
    }

    /**
     * Sets a validator for the question.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setValidator(callable $validator = null): static
    {
        $this->validator = null === $validator || $validator instanceof \Closure ? $validator : \Closure::fromCallable($validator);
=======
    public function setValidator(callable $validator = null)
    {
        $this->validator = $validator;
>>>>>>> origin/New-FakeMain

        return $this;
    }

    /**
     * Gets the validator for the question.
<<<<<<< HEAD
     */
    public function getValidator(): ?callable
=======
     *
     * @return callable|null
     */
    public function getValidator()
>>>>>>> origin/New-FakeMain
    {
        return $this->validator;
    }

    /**
     * Sets the maximum number of attempts.
     *
     * Null means an unlimited number of attempts.
     *
     * @return $this
     *
     * @throws InvalidArgumentException in case the number of attempts is invalid
     */
<<<<<<< HEAD
    public function setMaxAttempts(?int $attempts): static
=======
    public function setMaxAttempts(?int $attempts)
>>>>>>> origin/New-FakeMain
    {
        if (null !== $attempts && $attempts < 1) {
            throw new InvalidArgumentException('Maximum number of attempts must be a positive value.');
        }

        $this->attempts = $attempts;

        return $this;
    }

    /**
     * Gets the maximum number of attempts.
     *
     * Null means an unlimited number of attempts.
<<<<<<< HEAD
     */
    public function getMaxAttempts(): ?int
=======
     *
     * @return int|null
     */
    public function getMaxAttempts()
>>>>>>> origin/New-FakeMain
    {
        return $this->attempts;
    }

    /**
     * Sets a normalizer for the response.
     *
     * The normalizer can be a callable (a string), a closure or a class implementing __invoke.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setNormalizer(callable $normalizer): static
    {
        $this->normalizer = $normalizer instanceof \Closure ? $normalizer : \Closure::fromCallable($normalizer);
=======
    public function setNormalizer(callable $normalizer)
    {
        $this->normalizer = $normalizer;
>>>>>>> origin/New-FakeMain

        return $this;
    }

    /**
     * Gets the normalizer for the response.
     *
     * The normalizer can ba a callable (a string), a closure or a class implementing __invoke.
<<<<<<< HEAD
     */
    public function getNormalizer(): ?callable
=======
     *
     * @return callable|null
     */
    public function getNormalizer()
>>>>>>> origin/New-FakeMain
    {
        return $this->normalizer;
    }

    protected function isAssoc(array $array)
    {
        return (bool) \count(array_filter(array_keys($array), 'is_string'));
    }

    public function isTrimmable(): bool
    {
        return $this->trimmable;
    }

    /**
     * @return $this
     */
<<<<<<< HEAD
    public function setTrimmable(bool $trimmable): static
=======
    public function setTrimmable(bool $trimmable): self
>>>>>>> origin/New-FakeMain
    {
        $this->trimmable = $trimmable;

        return $this;
    }
}
