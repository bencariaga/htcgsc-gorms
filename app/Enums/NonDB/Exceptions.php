<?php

namespace App\Enums\NonDB;

use App\Traits\Has\HasValues;
use Illuminate\{Database\QueryException, Encryption\MissingAppKeyException};
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Throwable;

enum Exceptions
{
    use HasValues;

    public static function getErrorData(Throwable $e): ?array
    {
        return match (true) {
            $e instanceof MissingAppKeyException => ['title' => 'Missing App Key Error', 'message' => "'APP_KEY' in .env is missing. Make sure that '.env' exists and/or you generate the 'APP_KEY' in '.env'."],
            $e instanceof QueryException => ['title' => 'Database Connection Error', 'message' => 'Something went wrong connecting with the system\'s database. Please try again later.'],
            $e instanceof HttpExceptionInterface && $e->getStatusCode() === 500 => ['title' => 'Internal Server Error', 'message' => 'Something went wrong but unknown in the system.'],
            default => null,
        };
    }
}
