<?php

namespace Egulias\EmailValidator\Validation;

use Egulias\EmailValidator\EmailLexer;
<<<<<<< HEAD
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
use Egulias\EmailValidator\Result\MultipleErrors;
=======
use Egulias\EmailValidator\Validation\Exception\EmptyValidationList;
>>>>>>> origin/New-FakeMain

class MultipleValidationWithAnd implements EmailValidation
{
    /**
<<<<<<< HEAD
     * If one of validations fails, the remaining validations will be skept.
     * This means MultipleErrors will only contain a single error, the first found.
=======
     * If one of validations gets failure skips all succeeding validation.
     * This means MultipleErrors will only contain a single error which first found.
>>>>>>> origin/New-FakeMain
     */
    const STOP_ON_ERROR = 0;

    /**
     * All of validations will be invoked even if one of them got failure.
     * So MultipleErrors will contain all causes.
     */
    const ALLOW_ALL_ERRORS = 1;

    /**
     * @var EmailValidation[]
     */
    private $validations = [];

    /**
     * @var array
     */
    private $warnings = [];

    /**
     * @var MultipleErrors|null
     */
    private $error;

    /**
     * @var int
     */
    private $mode;

    /**
     * @param EmailValidation[] $validations The validations.
     * @param int               $mode        The validation mode (one of the constants).
     */
    public function __construct(array $validations, $mode = self::ALLOW_ALL_ERRORS)
    {
        if (count($validations) == 0) {
            throw new EmptyValidationList();
        }

        $this->validations = $validations;
        $this->mode = $mode;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isValid(string $email, EmailLexer $emailLexer) : bool
    {
        $result = true;
=======
    public function isValid($email, EmailLexer $emailLexer)
    {
        $result = true;
        $errors = [];
>>>>>>> origin/New-FakeMain
        foreach ($this->validations as $validation) {
            $emailLexer->reset();
            $validationResult = $validation->isValid($email, $emailLexer);
            $result = $result && $validationResult;
            $this->warnings = array_merge($this->warnings, $validation->getWarnings());
<<<<<<< HEAD
            if (!$validationResult) {
                $this->processError($validation);
            }
=======
            $errors = $this->addNewError($validation->getError(), $errors);
>>>>>>> origin/New-FakeMain

            if ($this->shouldStop($result)) {
                break;
            }
        }

<<<<<<< HEAD
        return $result;
    }

    private function initErrorStorage() : void
    {
        if (null === $this->error) {
            $this->error = new MultipleErrors();
        }
    }

    private function processError(EmailValidation $validation) : void
    {
        if (null !== $validation->getError()) {
            $this->initErrorStorage();
            /** @psalm-suppress PossiblyNullReference */
            $this->error->addReason($validation->getError()->reason());
        }
    }

    private function shouldStop(bool $result) : bool
=======
        if (!empty($errors)) {
            $this->error = new MultipleErrors($errors);
        }

        return $result;
    }

    /**
     * @param \Egulias\EmailValidator\Exception\InvalidEmail|null $possibleError
     * @param \Egulias\EmailValidator\Exception\InvalidEmail[] $errors
     *
     * @return \Egulias\EmailValidator\Exception\InvalidEmail[]
     */
    private function addNewError($possibleError, array $errors)
    {
        if (null !== $possibleError) {
            $errors[] = $possibleError;
        }

        return $errors;
    }

    /**
     * @param bool $result
     *
     * @return bool
     */
    private function shouldStop($result)
>>>>>>> origin/New-FakeMain
    {
        return !$result && $this->mode === self::STOP_ON_ERROR;
    }

    /**
     * Returns the validation errors.
<<<<<<< HEAD
     */
    public function getError() : ?InvalidEmail
=======
     *
     * @return MultipleErrors|null
     */
    public function getError()
>>>>>>> origin/New-FakeMain
    {
        return $this->error;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getWarnings() : array
=======
    public function getWarnings()
>>>>>>> origin/New-FakeMain
    {
        return $this->warnings;
    }
}
