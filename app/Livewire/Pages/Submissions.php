<?php

namespace App\Livewire\Pages;

use App\Enums\NonDB\{GoogleFormsStyling, SubmissionsStyling};
use App\Services\Miscellaneous\GoogleFormService;
use Illuminate\Support\Js;
use Livewire\{Attributes\Layout, Attributes\Title, Attributes\Url, Component};

#[Title('Submissions')]
#[Layout('layouts.personal-pages', ['padding' => '0px', 'important' => '!important'])]
class Submissions extends Component
{
    #[Url(as: 'file')]
    public ?string $selectedFileName = null;

    public ?string $loadingAction = null;

    public ?string $downloadType = null;

    public function mount(GoogleFormService $service)
    {
        $files = $service->getLogs();
        $date = now()->format('Y-m-d');

        if (!$this->selectedFileName || !$files->contains('name', $this->selectedFileName)) {
            $this->selectedFileName = $files->first()?->name ?: "google-forms-{$date}.log";
        }
    }

    public function downloadLog(array $submission)
    {
        return $this->processDownload($submission, 'log', 'Log', 'log');
    }

    public function downloadPdf(array $submission)
    {
        return $this->processDownload($submission, 'pdf', 'PDF', 'pdf');
    }

    public function downloadImage(array $submission)
    {
        return $this->processDownload($submission, 'image', 'Image', 'png');
    }

    protected function processDownload(array $submission, string $type, string $label, string $extension)
    {
        $this->downloadType = $label;
        $this->loadingAction = "download.{$type}";
        $this->dispatch('hide-loading-accounts');
        $service = app(GoogleFormService::class);

        return $service->downloadSubmission($submission, $type);
    }

    public function downloadFile(string $fileName = '')
    {
        $path = storage_path("logs/google-forms/{$fileName}");

        $this->dispatch('hide-loading-accounts');

        return response()->download($path);
    }

    public function fetchFile(string $name = '')
    {
        $this->loadingAction = 'fetchFile';
        $this->selectedFileName = $name;

        $this->dispatch('hide-loading-accounts');
    }

    public function render(GoogleFormService $service)
    {
        $items = $service->getStats();
        $files = $service->getLogs();

        $contactReferrer = $service->getContactReferrerUrl();
        $getSubmissionUrls = $service->getSubmissionUrls();

        $selectedFile = $files->firstWhere('name', $this->selectedFileName) ?? $files->first();
        $selectedFileName = $selectedFile ? $selectedFile->name : $this->selectedFileName;

        $submissions = $service->renderLog($selectedFileName);
        $renderedSubmissions = Js::from($submissions);

        $gfs = GoogleFormsStyling::variables($getSubmissionUrls);
        $sbms = SubmissionsStyling::variables($submissions);

        return view('livewire.pages.submissions', compact('submissions', 'renderedSubmissions', 'items', 'files', 'selectedFile', 'selectedFileName', 'contactReferrer', 'gfs', 'sbms') + $getSubmissionUrls);
    }
}
