<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Http\{Request, Response};

class NullException extends Exception
{
    public function render(Request $request): Response
    {
        $error = 'The requested resource or value is null or does not exist.';
        $message = $this->getMessage() ?: 'A null value was encountered where it was not expected.';

        return response(compact('error', 'message', 'request'), 404);
    }
}
