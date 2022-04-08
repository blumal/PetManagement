<?php

namespace Egulias\EmailValidator\Validation;

use Egulias\EmailValidator\EmailLexer;
<<<<<<< HEAD
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Result\Reason\RFCWarnings;
=======
use Egulias\EmailValidator\Exception\InvalidEmail;
use Egulias\EmailValidator\Validation\Error\RFCWarnings;
>>>>>>> origin/New-FakeMain

class NoRFCWarningsValidation extends RFCValidation
{
    /**
     * @var InvalidEmail|null
     */
    private $error;

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function isValid(string $email, EmailLexer $emailLexer) : bool
=======
    public function isValid($email, EmailLexer $emailLexer)
>>>>>>> origin/New-FakeMain
    {
        if (!parent::isValid($email, $emailLexer)) {
            return false;
        }

        if (empty($this->getWarnings())) {
            return true;
        }

<<<<<<< HEAD
        $this->error = new InvalidEmail(new RFCWarnings(), '');
=======
        $this->error = new RFCWarnings();
>>>>>>> origin/New-FakeMain

        return false;
    }

    /**
     * {@inheritdoc}
     */
<<<<<<< HEAD
    public function getError() : ?InvalidEmail
=======
    public function getError()
>>>>>>> origin/New-FakeMain
    {
        return $this->error ?: parent::getError();
    }
}
