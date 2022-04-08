<?php

namespace Illuminate\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\HttpException;
use Throwable;

class PostTooLargeException extends HttpException
{
    /**
     * Create a new "post too large" exception instance.
     *
<<<<<<< HEAD
     * @param  string  $message
=======
     * @param  string|null  $message
>>>>>>> origin/New-FakeMain
     * @param  \Throwable|null  $previous
     * @param  array  $headers
     * @param  int  $code
     * @return void
     */
<<<<<<< HEAD
    public function __construct($message = '', Throwable $previous = null, array $headers = [], $code = 0)
=======
    public function __construct($message = null, Throwable $previous = null, array $headers = [], $code = 0)
>>>>>>> origin/New-FakeMain
    {
        parent::__construct(413, $message, $previous, $headers, $code);
    }
}
