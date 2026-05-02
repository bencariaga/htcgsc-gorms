<?php

namespace App\Support\Formatters;

use Illuminate\Support\{Arr, Reflector};
use Illuminate\Support\Facades\{App, Request};

class ExceptionLogFormatter
{
    public function handle(object $exception): string
    {
        foreach (['class' => 'Exception', 'title' => 'Error', 'message' => 'Unknown error occurred.'] as $key => $default) {
            $$key = Reflector::isCallable([$exception, $key]) ? $exception->$key() : $default;
        }

        $phpVer = PHP_VERSION;
        $larVer = App::version();
        $host = Request::httpHost();
        $locale = App::getLocale();

        $markdown = "# {$class} - {$title}\n\n";
        $markdown .= "> {$message}\n\n";
        $markdown .= "## System Info\n";
        $markdown .= "* **PHP:** {$phpVer}\n";
        $markdown .= "* **Laravel:** {$larVer}\n";
        $markdown .= "* **Host:** {$host}\n";
        $markdown .= "* **Locale:** {$locale}\n\n";

        $markdown .= $this->formatStackTrace($exception);
        $markdown .= $this->formatRequestDetails();

        return $markdown;
    }

    private function formatStackTrace(object $exception): string
    {
        if (Reflector::isCallable([$exception, 'frames']) === false) {
            return "## Stack Trace\n\nNo stack trace available.\n";
        }

        $markdown = "## Stack Trace\n\n";

        foreach ($exception->frames() as $index => $frame) {
            $markdown .= "* **{$index}**: `{$frame->file()}:{$frame->line()}`\n";
        }

        return $markdown;
    }

    private function formatRequestDetails(): string
    {
        $method = Request::method();
        $path = str(Request::path())->start('/');
        $headers = $this->formatHeaderData(Request::header());

        return "\n## Request\n\n**Method:** {$method} | **Path:** {$path}\n\n## Headers\n\n{$headers}";
    }

    private function formatHeaderData(array $headers): string
    {
        if (blank($headers)) {
            return "No header data available.\n";
        }

        $output = '';

        foreach ($headers as $key => $value) {
            $val = Arr::accessible($value) ? collect($value)->join(', ') : (string) $value;
            $output .= "* **{$key}**: {$val}\n";
        }

        return $output;
    }
}
