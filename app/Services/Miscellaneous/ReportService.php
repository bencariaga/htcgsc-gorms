<?php

namespace App\Services\Miscellaneous;

use App\Actions\Report\{DeleteReport, DownloadReport, PrepareReportForm, RenderReport, SaveReport};
use App\Models\Report;
use Illuminate\Support\Collection;

class ReportService
{
    public function getReportsList(): Collection
    {
        return Report::orderBy('updated_at', 'desc')->get();
    }

    public function getFormData(?Report $selectedReport, Collection $reports): array
    {
        $formatted = $this->getFormattedReport($selectedReport);

        return app(PrepareReportForm::class)->execute($selectedReport, $reports, $formatted);
    }

    public function save(array $data): Report
    {
        return app(SaveReport::class)->execute($data);
    }

    public function delete(int $id): void
    {
        app(DeleteReport::class)->execute($id);
    }

    public function render(Report $report): Collection
    {
        return app(RenderReport::class)->execute($report);
    }

    public function getFormattedReport(?Report $report): ?array
    {
        return app(RenderReport::class)->formatForFrontend($report);
    }

    public function download(Report $report): array
    {
        return app(DownloadReport::class)->execute($report);
    }
}
