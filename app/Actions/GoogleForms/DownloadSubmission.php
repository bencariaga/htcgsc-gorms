<?php

namespace App\Actions\GoogleForms;

use App\{Enums\NonDB\GoogleFormsStyling, Services\Miscellaneous\GoogleFormService};
use App\Support\{BinaryFinder, VerticalFormatter};
use Illuminate\Support\{Carbon, Facades\Cache, Facades\Crypt, Facades\Response, Reflector};
use Spatie\Browsershot\Browsershot;

class DownloadSubmission
{
    public function execute(array $submission, string $type = 'log')
    {
        $cacheKey = "submission_data_{$type}_" . str(collect($submission)->toJson())->pipe(fn ($str) => Crypt::encrypt($str, false))->pipe('md5');

        $method = 'generate' . str($type)->ucfirst() . 'Content';

        $content = Cache::remember($cacheKey, now()->addMinutes(10), function () use ($method, $submission) {
            if (!Reflector::isCallable([$this, $method])) {
                return $this->$method($submission);
            }

            return $this->generateLogContent($submission);
        });

        $fileName = $this->generateFileName($submission, $type === 'image' ? 'png' : $type);

        $contentType = $type === 'log' ? 'text/plain' : ($type === 'pdf' ? 'application/pdf' : 'image/png');

        return Response::streamDownload(function () use ($content) {
            echo $content;
        }, $fileName, ['Content-Type' => $contentType]);
    }

    protected function generateLogContent(array $submission): string
    {
        $rawDate = $submission['created_at'] ?? $submission['Timestamp'] ?? now();

        $datetime = Carbon::parse($rawDate)->format('Y-m-d H:i:s');

        $appDebug = config('app.env');

        $header = str(VerticalFormatter::LOG_FORMAT)->replace(['%datetime%', '%env%', '%level_name%', '%message%'], [$datetime, $appDebug, 'INFO', 'Google Form Submission Data:']);

        $jsonContent = collect($submission)->toJson(JSON_PRETTY_PRINT);

        return "{$header}\n{$jsonContent}\n";
    }

    protected function generatePdfContent(array $submission): string
    {
        $html = $this->renderView($submission, 'pdf');

        return $this->browser($html)->format('Letter')->pdf();
    }

    protected function generateImageContent(array $submission): string
    {
        $html = $this->renderView($submission, 'png');

        return $this->browser($html)->fullPage()->screenshot();
    }

    private function renderView(array $submission, string $extension): string
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

    private function browser(string $html): Browsershot
    {
        $browser = Browsershot::html($html);

        $names = ['Chrome', 'Node', 'Npm'];

        $binaries = collect($names)->combine(collect($names)->map(fn ($name) => (string) str($name)->lower()))->toArray();

        foreach ($binaries as $method => $finder) {
            $setter = $method === 'Chrome' ? 'setChromePath' : "set{$method}Binary";

            if (Reflector::isCallable([$browser, $setter])) {
                $browser->$setter(BinaryFinder::$finder());
            }
        }

        if ($args = config('browsershot.chromium_arguments')) {
            $browser->addChromiumArguments($args);
        }

        return $browser->showBackground()->waitUntilNetworkIdle()->emulateMedia('screen');
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
