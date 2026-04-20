<?php

namespace App\Actions\GoogleForms;

use App\Support\{Json, Regex};
use Illuminate\Support\Facades\File;

class RenderSubmission
{
    public function execute(?string $fileName = null): array
    {
        $fileName ??= 'google-forms-' . now()->format('Y-m-d') . '.log';
        $logPath = storage_path("logs/google-forms/{$fileName}");

        if (!File::exists($logPath)) {
            return [];
        }

        $content = File::get($logPath);
        $matches = [];

        preg_match_all(Regex::googleFormLogPattern(), $content, $matches, PREG_SET_ORDER);

        return collect($matches)->map(function ($match) {
            $matchArray = (array) $match;
            $data = Json::decode($matchArray['json'] ?? '', true);

            return $data ? collect($data)->merge(['created_at' => $matchArray['timestamp'] ?? null])->toArray() : null;
        })->filter()->values()->all();
    }
}
