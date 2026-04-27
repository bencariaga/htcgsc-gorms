<?php

namespace App\Support;

use Illuminate\Support\{Arr, Js, Reflector};
use Illuminate\Support\Facades\{App, Request, Validator};

class LogToMarkdownConverter
{
    public function convert(mixed $item): string
    {
        if (blank($item)) {
            return "### Log Entry\nNo log data available.";
        }

        if (Validator::make(['item' => $item], ['item' => 'string'])->passes()) {
            return $this->convertString($item);
        }

        if ($this->isStandardLog($item)) {
            return $this->formatStandardLog($item);
        }

        return $this->formatExceptionLog($item);
    }

    private function isStandardLog(mixed $item): bool
    {
        return Reflector::isCallable([$item, 'getClass']) === false && (new \ReflectionClass($item))->hasProperty('message');
    }

    private function formatStandardLog(mixed $item): string
    {
        $level = str((string) ($item->level ?? 'INFO'))->upper();
        $message = (string) ($item->message ?? 'No message provided.');
        $timestamp = $item->datetime?->format('F j, Y | h:i:s A') ?? 'N/A';

        $appEnv = App::environment();
        $phpVer = PHP_VERSION;
        $larVer = App::version();
        $url = Request::fullUrl();

        $markdown = "# Log Type: {$level}\n\n";
        $markdown .= "## Message\n{$message}\n\n";
        $markdown .= "## Environment Details\n";
        $markdown .= "* **App Env:** {$appEnv}\n";
        $markdown .= "* **PHP Version:** {$phpVer}\n";
        $markdown .= "* **Laravel Version:** {$larVer}\n";
        $markdown .= "* **URL:** {$url}\n";
        $markdown .= "* **Timestamp:** {$timestamp}\n";

        return "{$markdown}{$this->formatContext($item->context ?? [])}";
    }

    private function formatContext(array $context): string
    {
        if (blank($context)) {
            return '';
        }

        $markdown = "\n## Context\n";

        foreach ($context as $key => $value) {
            $displayValue = (Arr::accessible($value) || Reflector::isCallable($value)) ? Js::from($value)->toHtml() : (string) $value;
            $markdown .= "* **{$key}**: {$displayValue}\n";
        }

        return $markdown;
    }

    private function formatExceptionLog(object $exception): string
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

    private function convertString(string $message): string
    {
        return "### Log Message\n{$message}";
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
