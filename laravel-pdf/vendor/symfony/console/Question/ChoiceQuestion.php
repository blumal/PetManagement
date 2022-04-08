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

/**
 * Represents a choice question.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ChoiceQuestion extends Question
{
<<<<<<< HEAD
    private array $choices;
    private bool $multiselect = false;
    private string $prompt = ' > ';
    private string $errorMessage = 'Value "%s" is invalid';
=======
    private $choices;
    private $multiselect = false;
    private $prompt = ' > ';
    private $errorMessage = 'Value "%s" is invalid';
>>>>>>> origin/New-FakeMain

    /**
     * @param string $question The question to ask to the user
     * @param array  $choices  The list of available choices
     * @param mixed  $default  The default answer to return
     */
<<<<<<< HEAD
    public function __construct(string $question, array $choices, mixed $default = null)
=======
    public function __construct(string $question, array $choices, $default = null)
>>>>>>> origin/New-FakeMain
    {
        if (!$choices) {
            throw new \LogicException('Choice question must have at least 1 choice available.');
        }

        parent::__construct($question, $default);

        $this->choices = $choices;
        $this->setValidator($this->getDefaultValidator());
        $this->setAutocompleterValues($choices);
    }

    /**
     * Returns available choices.
<<<<<<< HEAD
     */
    public function getChoices(): array
=======
     *
     * @return array
     */
    public function getChoices()
>>>>>>> origin/New-FakeMain
    {
        return $this->choices;
    }

    /**
     * Sets multiselect option.
     *
     * When multiselect is set to true, multiple choices can be answered.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setMultiselect(bool $multiselect): static
=======
    public function setMultiselect(bool $multiselect)
>>>>>>> origin/New-FakeMain
    {
        $this->multiselect = $multiselect;
        $this->setValidator($this->getDefaultValidator());

        return $this;
    }

    /**
     * Returns whether the choices are multiselect.
<<<<<<< HEAD
     */
    public function isMultiselect(): bool
=======
     *
     * @return bool
     */
    public function isMultiselect()
>>>>>>> origin/New-FakeMain
    {
        return $this->multiselect;
    }

    /**
     * Gets the prompt for choices.
<<<<<<< HEAD
     */
    public function getPrompt(): string
=======
     *
     * @return string
     */
    public function getPrompt()
>>>>>>> origin/New-FakeMain
    {
        return $this->prompt;
    }

    /**
     * Sets the prompt for choices.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setPrompt(string $prompt): static
=======
    public function setPrompt(string $prompt)
>>>>>>> origin/New-FakeMain
    {
        $this->prompt = $prompt;

        return $this;
    }

    /**
     * Sets the error message for invalid values.
     *
     * The error message has a string placeholder (%s) for the invalid value.
     *
     * @return $this
     */
<<<<<<< HEAD
    public function setErrorMessage(string $errorMessage): static
=======
    public function setErrorMessage(string $errorMessage)
>>>>>>> origin/New-FakeMain
    {
        $this->errorMessage = $errorMessage;
        $this->setValidator($this->getDefaultValidator());

        return $this;
    }

    private function getDefaultValidator(): callable
    {
        $choices = $this->choices;
        $errorMessage = $this->errorMessage;
        $multiselect = $this->multiselect;
        $isAssoc = $this->isAssoc($choices);

        return function ($selected) use ($choices, $errorMessage, $multiselect, $isAssoc) {
            if ($multiselect) {
                // Check for a separated comma values
                if (!preg_match('/^[^,]+(?:,[^,]+)*$/', (string) $selected, $matches)) {
                    throw new InvalidArgumentException(sprintf($errorMessage, $selected));
                }

                $selectedChoices = explode(',', (string) $selected);
            } else {
                $selectedChoices = [$selected];
            }

            if ($this->isTrimmable()) {
                foreach ($selectedChoices as $k => $v) {
                    $selectedChoices[$k] = trim((string) $v);
                }
            }

            $multiselectChoices = [];
            foreach ($selectedChoices as $value) {
                $results = [];
                foreach ($choices as $key => $choice) {
                    if ($choice === $value) {
                        $results[] = $key;
                    }
                }

                if (\count($results) > 1) {
                    throw new InvalidArgumentException(sprintf('The provided answer is ambiguous. Value should be one of "%s".', implode('" or "', $results)));
                }

                $result = array_search($value, $choices);

                if (!$isAssoc) {
                    if (false !== $result) {
                        $result = $choices[$result];
                    } elseif (isset($choices[$value])) {
                        $result = $choices[$value];
                    }
                } elseif (false === $result && isset($choices[$value])) {
                    $result = $value;
                }

                if (false === $result) {
                    throw new InvalidArgumentException(sprintf($errorMessage, $value));
                }

                // For associative choices, consistently return the key as string:
                $multiselectChoices[] = $isAssoc ? (string) $result : $result;
            }

            if ($multiselect) {
                return $multiselectChoices;
            }

            return current($multiselectChoices);
        };
    }
}
