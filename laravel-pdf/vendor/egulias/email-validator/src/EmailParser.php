<?php

namespace Egulias\EmailValidator;

<<<<<<< HEAD
use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Result\Result;
use Egulias\EmailValidator\Parser\LocalPart;
use Egulias\EmailValidator\Parser\DomainPart;
use Egulias\EmailValidator\Result\ValidEmail;
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Warning\EmailTooLong;
use Egulias\EmailValidator\Result\Reason\NoLocalPart;

class EmailParser extends Parser
=======
use Egulias\EmailValidator\Exception\ExpectingATEXT;
use Egulias\EmailValidator\Exception\NoLocalPart;
use Egulias\EmailValidator\Parser\DomainPart;
use Egulias\EmailValidator\Parser\LocalPart;
use Egulias\EmailValidator\Warning\EmailTooLong;

/**
 * EmailParser
 *
 * @author Eduardo Gulias Davis <me@egulias.com>
 */
class EmailParser
>>>>>>> origin/New-FakeMain
{
    const EMAIL_MAX_LENGTH = 254;

    /**
<<<<<<< HEAD
=======
     * @var array
     */
    protected $warnings = [];

    /**
>>>>>>> origin/New-FakeMain
     * @var string
     */
    protected $domainPart = '';

    /**
     * @var string
     */
    protected $localPart = '';
<<<<<<< HEAD

    public function parse(string $str) : Result
    {
        $result = parent::parse($str);

        $this->addLongEmailWarning($this->localPart, $this->domainPart);

        return $result;
    }
    
    protected function preLeftParsing(): Result
    {
        if (!$this->hasAtToken()) {
            return new InvalidEmail(new NoLocalPart(), $this->lexer->token["value"]);
        }
        return new ValidEmail();
    }

    protected function parseLeftFromAt(): Result
    {
        return $this->processLocalPart();
    }

    protected function parseRightFromAt(): Result
    {
        return $this->processDomainPart();
    }

    private function processLocalPart() : Result
    {
        $localPartParser = new LocalPart($this->lexer);
        $localPartResult = $localPartParser->parse();
        $this->localPart = $localPartParser->localPart();
        $this->warnings = array_merge($localPartParser->getWarnings(), $this->warnings);

        return $localPartResult;
    }

    private function processDomainPart() : Result
    {
        $domainPartParser = new DomainPart($this->lexer);
        $domainPartResult = $domainPartParser->parse();
        $this->domainPart = $domainPartParser->domainPart();
        $this->warnings = array_merge($domainPartParser->getWarnings(), $this->warnings);
        
        return $domainPartResult;
    }

    public function getDomainPart() : string
=======
    /**
     * @var EmailLexer
     */
    protected $lexer;

    /**
     * @var LocalPart
     */
    protected $localPartParser;

    /**
     * @var DomainPart
     */
    protected $domainPartParser;

    public function __construct(EmailLexer $lexer)
    {
        $this->lexer = $lexer;
        $this->localPartParser = new LocalPart($this->lexer);
        $this->domainPartParser = new DomainPart($this->lexer);
    }

    /**
     * @param string $str
     * @return array
     */
    public function parse($str)
    {
        $this->lexer->setInput($str);

        if (!$this->hasAtToken()) {
            throw new NoLocalPart();
        }


        $this->localPartParser->parse($str);
        $this->domainPartParser->parse($str);

        $this->setParts($str);

        if ($this->lexer->hasInvalidTokens()) {
            throw new ExpectingATEXT();
        }

        return array('local' => $this->localPart, 'domain' => $this->domainPart);
    }

    /**
     * @return Warning\Warning[]
     */
    public function getWarnings()
    {
        $localPartWarnings = $this->localPartParser->getWarnings();
        $domainPartWarnings = $this->domainPartParser->getWarnings();
        $this->warnings = array_merge($localPartWarnings, $domainPartWarnings);

        $this->addLongEmailWarning($this->localPart, $this->domainPart);

        return $this->warnings;
    }

    /**
     * @return string
     */
    public function getParsedDomainPart()
>>>>>>> origin/New-FakeMain
    {
        return $this->domainPart;
    }

<<<<<<< HEAD
    public function getLocalPart() : string
    {
        return $this->localPart;
    }

    private function addLongEmailWarning(string $localPart, string $parsedDomainPart) : void
=======
    /**
     * @param string $email
     */
    protected function setParts($email)
    {
        $parts = explode('@', $email);
        $this->domainPart = $this->domainPartParser->getDomainPart();
        $this->localPart = $parts[0];
    }

    /**
     * @return bool
     */
    protected function hasAtToken()
    {
        $this->lexer->moveNext();
        $this->lexer->moveNext();
        if ($this->lexer->token['type'] === EmailLexer::S_AT) {
            return false;
        }

        return true;
    }

    /**
     * @param string $localPart
     * @param string $parsedDomainPart
     */
    protected function addLongEmailWarning($localPart, $parsedDomainPart)
>>>>>>> origin/New-FakeMain
    {
        if (strlen($localPart . '@' . $parsedDomainPart) > self::EMAIL_MAX_LENGTH) {
            $this->warnings[EmailTooLong::CODE] = new EmailTooLong();
        }
    }
}
