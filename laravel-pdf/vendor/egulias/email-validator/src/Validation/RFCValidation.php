<?php

namespace Egulias\EmailValidator\Validation;

use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\EmailParser;
<<<<<<< HEAD
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Result\Reason\ExceptionFound;
=======
use Egulias\EmailValidator\Exception\InvalidEmail;
>>>>>>> origin/New-FakeMain

class RFCValidation implements EmailValidation
{
    /**
     * @var EmailParser|null
     */
    private $parser;

    /**
     * @var array
     */
    private $warnings = [];

    /**
<<<<<<< HEAD
     * @var ?InvalidEmail
     */
    private $error;

    public function isValid(string $email, EmailLexer $emailLexer) : bool
    {
        $this->parser = new EmailParser($emailLexer);
        try {
            $result = $this->parser->parse($email);
            $this->warnings = $this->parser->getWarnings();
            if ($result->isInvalid()) {
                /** @psalm-suppress PropertyTypeCoercion */
                $this->error = $result;
                return false;
            }
        } catch (\Exception $invalid) {
            $this->error = new InvalidEmail(new ExceptionFound($invalid), '');
            return false;
        }

        return true;
    }

    public function getError() : ?InvalidEmail
=======
     * @var InvalidEmail|null
     */
    private $error;

    public function isValid($email, EmailLexer $emailLexer)
    {
        $this->parser = new EmailParser($emailLexer);
        try {
            $this->parser->parse((string)$email);
        } catch (InvalidEmail $invalid) {
            $this->error = $invalid;
            return false;
        }

        $this->warnings = $this->parser->getWarnings();
        return true;
    }

    public function getError()
>>>>>>> origin/New-FakeMain
    {
        return $this->error;
    }

<<<<<<< HEAD
    public function getWarnings() : array
=======
    public function getWarnings()
>>>>>>> origin/New-FakeMain
    {
        return $this->warnings;
    }
}
