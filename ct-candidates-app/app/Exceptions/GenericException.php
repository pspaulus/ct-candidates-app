<?php

namespace App\Exceptions;

use Exception;

class GenericException extends Exception
{
    protected mixed $status = 400;
    protected $message;

    public function __construct($message, $status=400, $code = 0, Exception $previous = null)
    {
        $this->message = $message;
        $this->status = $status;

        parent::__construct($message, $code, $previous);
    }

    public function getStatus() : int
    {
        return $this->status;
    }
}