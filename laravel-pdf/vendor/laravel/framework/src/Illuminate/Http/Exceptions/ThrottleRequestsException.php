<?php

namespace Illuminate\Http\Exceptions;

use Symfony\Component\HttpKernel\Exception\TooManyRequestsHttpException;
use Throwable;

class ThrottleRequestsException extends TooManyRequestsHttpException
{
    /**
     * Create a new throttle requests exception instance.
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
        parent::__construct(null, $message, $previous, $code, $headers);
    }
}
