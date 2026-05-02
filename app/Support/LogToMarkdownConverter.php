<?php

namespace App\Support;

use Illuminate\Support\{Facades\Validator, Reflector};

class LogToMarkdownConverter
{
    public function convert(mixed $item): string
    {
        if (blank($item)) {
            return "### Log Entry\nNo log data available.";
        }

        if (Validator::make(['item' => $item], ['item' => 'string'])->passes()) {
            return app(Formatters\StringLogFormatter::class)->handle($item);
        }

        if ($this->isStandardLog($item)) {
            return app(Formatters\StandardLogFormatter::class)->handle($item);
        }

        return app(Formatters\ExceptionLogFormatter::class)->handle($item);
    }

    private function isStandardLog(mixed $item): bool
    {
        return Reflector::isCallable([$item, 'getClass']) === false && (new \ReflectionClass($item))->hasProperty('message');
    }
}
