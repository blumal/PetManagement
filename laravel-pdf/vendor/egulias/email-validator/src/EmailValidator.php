<?php

namespace Egulias\EmailValidator;

<<<<<<< HEAD
use Egulias\EmailValidator\Result\InvalidEmail;
=======
use Egulias\EmailValidator\Exception\InvalidEmail;
>>>>>>> origin/New-FakeMain
use Egulias\EmailValidator\Validation\EmailValidation;

class EmailValidator
{
    /**
     * @var EmailLexer
     */
    private $lexer;

    /**
     * @var Warning\Warning[]
     */
<<<<<<< HEAD
    private $warnings = [];

    /**
     * @var ?InvalidEmail
     */
    private $error;
=======
    protected $warnings = [];

    /**
     * @var InvalidEmail|null
     */
    protected $error;
>>>>>>> origin/New-FakeMain

    public function __construct()
    {
        $this->lexer = new EmailLexer();
    }

    /**
     * @param string          $email
     * @param EmailValidation $emailValidation
     * @return bool
     */
<<<<<<< HEAD
    public function isValid(string $email, EmailValidation $emailValidation)
=======
    public function isValid($email, EmailValidation $emailValidation)
>>>>>>> origin/New-FakeMain
    {
        $isValid = $emailValidation->isValid($email, $this->lexer);
        $this->warnings = $emailValidation->getWarnings();
        $this->error = $emailValidation->getError();

        return $isValid;
    }

    /**
     * @return boolean
     */
    public function hasWarnings()
    {
        return !empty($this->warnings);
    }

    /**
     * @return array
     */
    public function getWarnings()
    {
        return $this->warnings;
    }

    /**
     * @return InvalidEmail|null
     */
    public function getError()
    {
        return $this->error;
    }
}
