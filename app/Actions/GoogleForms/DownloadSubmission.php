<?php

namespace App\Actions\GoogleForms;

use App\Traits\Handles\HandlesBrowsershot;
use Illuminate\Support\Facades\{Cache, Crypt, Response};

class DownloadSubmission
{
    use HandlesBrowsershot;

    public function execute(array $submission, string $type = 'log')
    {
        $cacheKey = "submission_data_{$type}_" . str(collect($submission)->toJson())->pipe(fn ($str) => Crypt::encrypt($str, false))->pipe('md5');

        $content = Cache::remember($cacheKey, now()->addMinutes(10), fn () => match ($type) {
            'pdf' => app(Generators\GeneratePdfSubmission::class)->handle($submission),
            'image' => app(Generators\GenerateImageSubmission::class)->handle($submission),
            default => app(Generators\GenerateLogSubmission::class)->handle($submission),
        });

        $fileName = $this->generateFileName($submission, $type === 'image' ? 'png' : $type);

        $contentType = match ($type) {
            'pdf' => 'application/pdf',
            'image' => 'image/png',
            default => 'text/plain',
        };

        return Response::streamDownload(function () use ($content) {
            echo $content;
        }, $fileName, ['Content-Type' => $contentType]);
    }
}
