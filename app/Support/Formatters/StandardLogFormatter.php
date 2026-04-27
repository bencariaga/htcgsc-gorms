<?php

namespace App\Support\Formatters;

use Illuminate\Support\{Arr, Js, Reflector};
use Illuminate\Support\Facades\{App, Request};

class StandardLogFormatter
{
    public function handle(mixed $item): string
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
}
