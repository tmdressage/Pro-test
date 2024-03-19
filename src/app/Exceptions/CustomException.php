<?php

namespace App\Exceptions;

use Exception;

class CustomException extends Exception
{
    protected $message;

    public function __construct($message = null, $code = 0, Throwable $previous = null)
    {
        parent::__construct($message ?: 'Custom Exception', $code, $previous);
    }
}
