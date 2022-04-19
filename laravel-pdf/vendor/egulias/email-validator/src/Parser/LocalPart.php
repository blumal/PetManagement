<?php

namespace Egulias\EmailValidator\Parser;

<<<<<<< HEAD
use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Result\Result;
use Egulias\EmailValidator\Result\ValidEmail;
use Egulias\EmailValidator\Result\InvalidEmail;
use Egulias\EmailValidator\Warning\LocalTooLong;
use Egulias\EmailValidator\Result\Reason\DotAtEnd;
use Egulias\EmailValidator\Result\Reason\DotAtStart;
use Egulias\EmailValidator\Result\Reason\ConsecutiveDot;
use Egulias\EmailValidator\Result\Reason\ExpectingATEXT;
use Egulias\EmailValidator\Parser\CommentStrategy\LocalComment;

class LocalPart extends PartParser
{
    /**
     * @var string
     */
    private $localPart = '';


    public function parse() : Result
    {
        $this->lexer->startRecording();

        while ($this->lexer->token['type'] !== EmailLexer::S_AT && null !== $this->lexer->token['type']) {
            if ($this->hasDotAtStart()) {
                return new InvalidEmail(new DotAtStart(), $this->lexer->token['value']);
            }

            if ($this->lexer->token['type'] === EmailLexer::S_DQUOTE) {
                $dquoteParsingResult = $this->parseDoubleQuote();

                //Invalid double quote parsing
                if($dquoteParsingResult->isInvalid()) {
                    return $dquoteParsingResult;
                }
            }

            if ($this->lexer->token['type'] === EmailLexer::S_OPENPARENTHESIS || 
                $this->lexer->token['type'] === EmailLexer::S_CLOSEPARENTHESIS ) {
                $commentsResult = $this->parseComments();

                //Invalid comment parsing
                if($commentsResult->isInvalid()) {
                    return $commentsResult;
                }
            }

            if ($this->lexer->token['type'] === EmailLexer::S_DOT && $this->lexer->isNextToken(EmailLexer::S_DOT)) {
                return new InvalidEmail(new ConsecutiveDot(), $this->lexer->token['value']);
            }
=======
use Egulias\EmailValidator\Exception\DotAtEnd;
use Egulias\EmailValidator\Exception\DotAtStart;
use Egulias\EmailValidator\EmailLexer;
use Egulias\EmailValidator\Exception\ExpectingAT;
use Egulias\EmailValidator\Exception\ExpectingATEXT;
use Egulias\EmailValidator\Exception\UnclosedQuotedString;
use Egulias\EmailValidator\Exception\UnopenedComment;
use Egulias\EmailValidator\Warning\CFWSWithFWS;
use Egulias\EmailValidator\Warning\LocalTooLong;

class LocalPart extends Parser
{
    public function parse($localPart)
    {
        $parseDQuote = true;
        $closingQuote = false;
        $openedParenthesis = 0;
        $totalLength = 0;

        while ($this->lexer->token['type'] !== EmailLexer::S_AT && null !== $this->lexer->token['type']) {
            if ($this->lexer->token['type'] === EmailLexer::S_DOT && null === $this->lexer->getPrevious()['type']) {
                throw new DotAtStart();
            }

            $closingQuote = $this->checkDQUOTE($closingQuote);
            if ($closingQuote && $parseDQuote) {
                $parseDQuote = $this->parseDoubleQuote();
            }

            if ($this->lexer->token['type'] === EmailLexer::S_OPENPARENTHESIS) {
                $this->parseComments();
                $openedParenthesis += $this->getOpenedParenthesis();
            }

            if ($this->lexer->token['type'] === EmailLexer::S_CLOSEPARENTHESIS) {
                if ($openedParenthesis === 0) {
                    throw new UnopenedComment();
                }

                $openedParenthesis--;
            }

            $this->checkConsecutiveDots();
>>>>>>> origin/New-FakeMain

            if ($this->lexer->token['type'] === EmailLexer::S_DOT &&
                $this->lexer->isNextToken(EmailLexer::S_AT)
            ) {
<<<<<<< HEAD
                return new InvalidEmail(new DotAtEnd(), $this->lexer->token['value']);
            }

            $resultEscaping = $this->validateEscaping();
            if ($resultEscaping->isInvalid()) {
                return $resultEscaping;
            }

            $resultToken = $this->validateTokens(false);
            if ($resultToken->isInvalid()) {
                return $resultToken;
            }

            $resultFWS = $this->parseLocalFWS();
            if($resultFWS->isInvalid()) {
                return $resultFWS;
            }

            $this->lexer->moveNext();
        }

        $this->lexer->stopRecording();
        $this->localPart = rtrim($this->lexer->getAccumulatedValues(), '@');
        if (strlen($this->localPart) > LocalTooLong::LOCAL_PART_LENGTH) {
            $this->warnings[LocalTooLong::CODE] = new LocalTooLong();
        }

        return new ValidEmail();
    }

    protected function validateTokens(bool $hasComments) : Result
    {
        $invalidTokens = array(
            EmailLexer::S_COMMA => EmailLexer::S_COMMA,
            EmailLexer::S_CLOSEBRACKET => EmailLexer::S_CLOSEBRACKET,
            EmailLexer::S_OPENBRACKET => EmailLexer::S_OPENBRACKET,
            EmailLexer::S_GREATERTHAN => EmailLexer::S_GREATERTHAN,
            EmailLexer::S_LOWERTHAN => EmailLexer::S_LOWERTHAN,
            EmailLexer::S_COLON => EmailLexer::S_COLON,
            EmailLexer::S_SEMICOLON => EmailLexer::S_SEMICOLON,
            EmailLexer::INVALID => EmailLexer::INVALID
        );
        if (isset($invalidTokens[$this->lexer->token['type']])) {
            return new InvalidEmail(new ExpectingATEXT('Invalid token found'), $this->lexer->token['value']);
        }
        return new ValidEmail();
    }

    public function localPart() : string
    {
        return $this->localPart;
    }

    private function parseLocalFWS() : Result 
    {
        $foldingWS = new FoldingWhiteSpace($this->lexer);
        $resultFWS = $foldingWS->parse();
        if ($resultFWS->isValid()) {
            $this->warnings = array_merge($this->warnings, $foldingWS->getWarnings());
        }
        return $resultFWS;
    }

    private function hasDotAtStart() : bool
    {
            return $this->lexer->token['type'] === EmailLexer::S_DOT && null === $this->lexer->getPrevious()['type'];
    }

    private function parseDoubleQuote() : Result
    {
        $dquoteParser = new DoubleQuote($this->lexer);
        $parseAgain = $dquoteParser->parse();
        $this->warnings = array_merge($this->warnings, $dquoteParser->getWarnings());
=======
                throw new DotAtEnd();
            }

            $this->warnEscaping();
            $this->isInvalidToken($this->lexer->token, $closingQuote);

            if ($this->isFWS()) {
                $this->parseFWS();
            }

            $totalLength += strlen($this->lexer->token['value']);
            $this->lexer->moveNext();
        }

        if ($totalLength > LocalTooLong::LOCAL_PART_LENGTH) {
            $this->warnings[LocalTooLong::CODE] = new LocalTooLong();
        }
    }

    /**
     * @return bool
     */
    protected function parseDoubleQuote()
    {
        $parseAgain = true;
        $special = array(
            EmailLexer::S_CR => true,
            EmailLexer::S_HTAB => true,
            EmailLexer::S_LF => true
        );

        $invalid = array(
            EmailLexer::C_NUL => true,
            EmailLexer::S_HTAB => true,
            EmailLexer::S_CR => true,
            EmailLexer::S_LF => true
        );
        $setSpecialsWarning = true;

        $this->lexer->moveNext();

        while ($this->lexer->token['type'] !== EmailLexer::S_DQUOTE && null !== $this->lexer->token['type']) {
            $parseAgain = false;
            if (isset($special[$this->lexer->token['type']]) && $setSpecialsWarning) {
                $this->warnings[CFWSWithFWS::CODE] = new CFWSWithFWS();
                $setSpecialsWarning = false;
            }
            if ($this->lexer->token['type'] === EmailLexer::S_BACKSLASH && $this->lexer->isNextToken(EmailLexer::S_DQUOTE)) {
                $this->lexer->moveNext();
            }

            $this->lexer->moveNext();

            if (!$this->escaped() && isset($invalid[$this->lexer->token['type']])) {
                throw new ExpectingATEXT();
            }
        }

        $prev = $this->lexer->getPrevious();

        if ($prev['type'] === EmailLexer::S_BACKSLASH) {
            if (!$this->checkDQUOTE(false)) {
                throw new UnclosedQuotedString();
            }
        }

        if (!$this->lexer->isNextToken(EmailLexer::S_AT) && $prev['type'] !== EmailLexer::S_BACKSLASH) {
            throw new ExpectingAT();
        }
>>>>>>> origin/New-FakeMain

        return $parseAgain;
    }

<<<<<<< HEAD
    protected function parseComments(): Result
    {
        $commentParser = new Comment($this->lexer, new LocalComment());
        $result = $commentParser->parse();
        $this->warnings = array_merge($this->warnings, $commentParser->getWarnings());
        if($result->isInvalid()) {
            return $result;
        }
        return $result;
    }

    private function validateEscaping() : Result
    {
        //Backslash found
        if ($this->lexer->token['type'] !== EmailLexer::S_BACKSLASH) {
            return new ValidEmail();
        }

        if ($this->lexer->isNextToken(EmailLexer::GENERIC)) {
            return new InvalidEmail(new ExpectingATEXT('Found ATOM after escaping'), $this->lexer->token['value']);
        }

        if (!$this->lexer->isNextTokenAny(array(EmailLexer::S_SP, EmailLexer::S_HTAB, EmailLexer::C_DEL))) {
            return new ValidEmail();
        }

        return new ValidEmail();
    }
}
=======
    /**
     * @param bool $closingQuote
     */
    protected function isInvalidToken(array $token, $closingQuote)
    {
        $forbidden = array(
            EmailLexer::S_COMMA,
            EmailLexer::S_CLOSEBRACKET,
            EmailLexer::S_OPENBRACKET,
            EmailLexer::S_GREATERTHAN,
            EmailLexer::S_LOWERTHAN,
            EmailLexer::S_COLON,
            EmailLexer::S_SEMICOLON,
            EmailLexer::INVALID
        );

        if (in_array($token['type'], $forbidden) && !$closingQuote) {
            throw new ExpectingATEXT();
        }
    }
}
>>>>>>> origin/New-FakeMain
