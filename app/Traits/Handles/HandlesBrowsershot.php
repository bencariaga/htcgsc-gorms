<?php

namespace App\Traits\Handles;

use App\{Enums\NonDB\GoogleFormsStyling, Services\Miscellaneous\GoogleFormService};
use Illuminate\Support\Carbon;
use Spatie\Browsershot\Browsershot;

trait HandlesBrowsershot
{
    protected function renderView(array $submission, string $extension): string
    {
        $activeSubmission = $submission;
        $service = app(GoogleFormService::class);
        $urls = $service->getSubmissionUrls();
        $gfs = GoogleFormsStyling::variables($urls);
        $contactReferrer = $service->getContactReferrerUrl();
        $selectedFileName = $this->generateFileName($submission, $extension);
        $submissions = [$submission];
        $newTab = '';
        $mode = $extension === 'pdf' ? 'pdf' : ($extension === 'png' ? 'image' : null);
        $data = compact('activeSubmission', 'gfs', 'contactReferrer', 'selectedFileName', 'submissions', 'newTab', 'mode');

        return view('components.google-forms.base', $data)->render();
    }

    protected function browser(string $html): Browsershot
    {
        $browser = Browsershot::html($html)->setChromePath('/usr/bin/chromium-browser')->setNodeBinary('/usr/bin/node')->setNpmBinary('/usr/bin/npm');

        if ($args = config('browsershot.chromium_arguments')) {
            $browser->addChromiumArguments($args);
        }

        return $browser->showBackground()->waitUntilNetworkIdle()->noSandbox()->emulateMedia('screen');
    }

    public function generateFileName(array $submission, string $extension): string
    {
        $gForm = 'google-form';
        $rawDate = $submission['created_at'] ?? $submission['Timestamp'] ?? now();
        $datetimeFormat = Carbon::parse($rawDate)->format('Y-m-d-H-i-s');
        $fields = ['lastName', 'firstName', 'middleName'];
        $names = [];

        foreach ($fields as $field) {
            $label = str($field)->headline()->append(' (Referral)')->value();
            $names[$field] = str($submission[$label] ?? 'data')->slug();
        }

        return "{$gForm}-{$datetimeFormat}-{$names['lastName']}-{$names['firstName']}-{$names['middleName']}.{$extension}";
    }
}
