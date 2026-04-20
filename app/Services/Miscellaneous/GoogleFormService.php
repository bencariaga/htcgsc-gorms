<?php

namespace App\Services\Miscellaneous;

use App\Actions\GoogleForms\{DownloadSubmission, GetLogFiles, GetSidebarStats, GetUrls, ProcessSubmission, RenderSubmission};
use Illuminate\Support\Collection;

class GoogleFormService
{
    public function __construct(protected ProcessSubmission $processSubmission, protected RenderSubmission $renderSubmission, protected DownloadSubmission $downloadSubmission, protected GetLogFiles $getLogFiles, protected GetSidebarStats $getSidebarStats, protected GetUrls $getUrls) {}

    public function processSubmission(array $data): bool
    {
        return $this->processSubmission->execute($data);
    }

    public function getLogs(): Collection
    {
        return $this->getLogFiles->execute();
    }

    public function getStats(): array
    {
        return $this->getSidebarStats->execute();
    }

    public function renderLog(?string $fileName): array
    {
        return $this->renderSubmission->execute($fileName);
    }

    public function getSubmissionUrls(): array
    {
        return $this->getUrls->getSubmissionUrls();
    }

    public function getContactReferrerUrl(): string
    {
        return $this->getUrls->getContactReferrerUrl();
    }

    public function downloadSubmission(array $submission, string $type = 'log')
    {
        return $this->downloadSubmission->execute($submission, $type);
    }

    public function generateFileName(array $submission, string $extension): string
    {
        return $this->downloadSubmission->generateFileName($submission, $extension);
    }
}
