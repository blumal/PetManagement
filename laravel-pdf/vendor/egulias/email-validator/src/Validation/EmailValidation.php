<?php

namespace Egulias\EmailValidator\Validation;

use Egulias\EmailValidator\EmailLexer;
<<<<<<< HEAD
use Egulias\EmailValidator\Result\InvalidEmail;
=======
use Egulias\EmailValidator\Exception\InvalidEmail;
>>>>>>> origin/New-FakeMain
use Egulias\EmailValidator\Warning\Warning;

interface EmailValidation
{
    /**
     * Returns true if the given email is valid.
     *
     * @param string     $email      The email you want to validate.
     * @param EmailLexer $emailLexer The email lexer.
     *
     * @return bool
     */
<<<<<<< HEAD
    public function isValid(string $email, EmailLexer $emailLexer) : bool;
=======
    public function isValid($email, EmailLexer $emailLexer);
>>>>>>> origin/New-FakeMain

    /**
     * Returns the validation error.
     *
     * @return InvalidEmail|null
     */
<<<<<<< HEAD
    public function getError() : ?InvalidEmail;
=======
    public function getError();
>>>>>>> origin/New-FakeMain

    /**
     * Returns the validation warnings.
     *
     * @return Warning[]
     */
<<<<<<< HEAD
    public function getWarnings() : array;
=======
    public function getWarnings();
>>>>>>> origin/New-FakeMain
}
