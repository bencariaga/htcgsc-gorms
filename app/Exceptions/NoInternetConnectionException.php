<?php

namespace App\Exceptions;

use Exception;
use Symfony\Component\HttpFoundation\Response;

class NoInternetConnectionException extends Exception
{
    public function render()
    {
        $error = 'Connection is failed.';
        $message = 'The system was not able to connect to the internet. Please check your connection and try again.';

        return response()->json(compact('error', 'message'), Response::HTTP_SERVICE_UNAVAILABLE);
    }
}
