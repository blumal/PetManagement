<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\HttpKernel\Exception;

/**
 * HttpException.
 *
 * @author Kris Wallsmith <kris@symfony.com>
 */
class HttpException extends \RuntimeException implements HttpExceptionInterface
{
<<<<<<< HEAD
    private int $statusCode;
    private array $headers;

    public function __construct(int $statusCode, string $message = '', \Throwable $previous = null, array $headers = [], int $code = 0)
    {
=======
    private $statusCode;
    private $headers;

    public function __construct(int $statusCode, ?string $message = '', \Throwable $previous = null, array $headers = [], ?int $code = 0)
    {
        if (null === $message) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'Passing null as $message to "%s()" is deprecated, pass an empty string instead.', __METHOD__);

            $message = '';
        }
        if (null === $code) {
            trigger_deprecation('symfony/http-kernel', '5.3', 'Passing null as $code to "%s()" is deprecated, pass 0 instead.', __METHOD__);

            $code = 0;
        }

>>>>>>> origin/New-FakeMain
        $this->statusCode = $statusCode;
        $this->headers = $headers;

        parent::__construct($message, $code, $previous);
    }

<<<<<<< HEAD
    public function getStatusCode(): int
=======
    public function getStatusCode()
>>>>>>> origin/New-FakeMain
    {
        return $this->statusCode;
    }

<<<<<<< HEAD
    public function getHeaders(): array
=======
    public function getHeaders()
>>>>>>> origin/New-FakeMain
    {
        return $this->headers;
    }

<<<<<<< HEAD
=======
    /**
     * Set response headers.
     *
     * @param array $headers Response headers
     */
>>>>>>> origin/New-FakeMain
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }
}
