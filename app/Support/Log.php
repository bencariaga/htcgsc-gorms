<?php

namespace App\Support;

use BeyondCode\QueryDetector\Outputs\Output;
use Illuminate\Support\{Collection, Facades\Log as LaravelLog, Str};
use Symfony\Component\HttpFoundation\Response;

class Log implements Output
{
    protected string $channel;

    public function boot()
    {
        $this->channel = (string) config('querydetector.log_channel', 'daily');
    }

    public function output(Collection $detectedQueries, Response $response)
    {
        $url = request()->fullUrl();
        $status = $response->getStatusCode();

        $this->log("Detected N + 1 Query on [{$url}] with Status [{$status}]");

        foreach ($detectedQueries as $detectedQuery) {
            $this->logQueryDetails($detectedQuery);
        }
    }

    private function logQueryDetails(array $detectedQuery): void
    {
        $EOL = Str::of("\n");

        $logOutput = "Model: {$detectedQuery['model']}{$EOL}";
        $logOutput .= "Relation: {$detectedQuery['relation']}{$EOL}";
        $logOutput .= "Num-Called: {$detectedQuery['count']}{$EOL}";
        $logOutput .= "Call-Stack:{$EOL}";

        foreach ($detectedQuery['sources'] as $source) {
            $logOutput .= "#{$source->index} {$source->name}:{$source->line}{$EOL}";
        }

        $this->log($logOutput);
    }

    private function log(string $message)
    {
        LaravelLog::channel($this->channel)->warning($message);
    }
}
