<?php

namespace App\Support\Formatters;

class StringLogFormatter
{
    public function handle(string $message): string
    {
        return "### Log Message\n{$message}";
    }
}
