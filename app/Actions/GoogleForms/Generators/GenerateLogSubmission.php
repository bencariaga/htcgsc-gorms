<?php

namespace App\Actions\GoogleForms\Generators;

use App\Support\VerticalFormatter;
use Illuminate\Support\Carbon;

class GenerateLogSubmission
{
    public function handle(array $submission): string
    {
        $rawDate = $submission['created_at'] ?? $submission['Timestamp'] ?? now();
        $datetime = Carbon::parse($rawDate)->format('Y-m-d H:i:s');
        $appDebug = config('app.env');

        $header = str(VerticalFormatter::LOG_FORMAT)->replace(['%datetime%', '%env%', '%level_name%', '%message%'], [$datetime, $appDebug, 'INFO', 'Google Form Submission Data:']);
        $jsonContent = collect($submission)->toJson(JSON_PRETTY_PRINT);

        return "{$header}\n{$jsonContent}\n";
    }
}
