<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NoInternetConnectionException extends Exception
{
    public function __construct(string $message = 'The system was not able to connect to the internet. Please check your connection and try again.', int $code = 0, ?\Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        $error = 'Connection is failed.';
        $message = 'The system was not able to connect to the internet. Please check your connection and try again.';

        return response()->json(compact('error', 'message'), Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
