<?php

namespace App\Livewire\Pages;

use App\{Models\Report, Services\Miscellaneous\ReportService};
use Illuminate\Support\Collection;
use Livewire\{Attributes\Layout, Attributes\Title, Component};

class Reports extends Component
{
    public ?int $selectedReportId = null;

    public ?int $activeId = null;

    public ?Collection $reportData = null;

    public function boot(): void
    {
        $this->reportData = collect();
    }

    public function mount(ReportService $service): void
    {
        if ($this->selectedReportId) {
            $this->selectReport($this->selectedReportId, $service);
        }
    }

    public function selectReport(int $id, ReportService $service): void
    {
        $this->selectedReportId = $id;
        $this->activeId = $id;

        $report = Report::find($id);

        if ($report) {
            $this->reportData = $service->render($report);
            $this->dispatch('report-loaded', data: $service->getFormattedReport($report));
        }
    }

    public function save(array $data, ReportService $service): void
    {
        $report = $service->save($data);
        $reportId = $report->report_id;
        $title = $report->title;

        $this->selectReport($reportId, $service);

        $this->dispatch('notify', type: 'success', message: "Report \"<strong>{$title}</strong>\" has been saved successfully!");
    }

    public function deleteReport(int $id, ReportService $service): void
    {
        $report = Report::find($id);

        if (!$report) {
            return;
        }

        $title = $report->title;

        $service->delete($id);

        if ($this->activeId === $id) {
            $this->createNewReport();
        }

        $this->dispatch('notify', type: 'success', message: "Report \"<strong>{$title}</strong>\" has been deleted successfully!");
    }

    public function createNewReport(): void
    {
        $this->reset(['selectedReportId', 'activeId', 'reportData']);
        $this->dispatch('report-loaded', data: null);
    }

    public function download(Report $report, ReportService $service)
    {
        $file = $service->download($report);

        $this->dispatch('notify', type: 'success', message: "Report \"<strong>{$file['filename']}</strong>\" has been downloaded successfully!");

        return response()->streamDownload(function () use ($file) {
            echo $file['content'];
        }, $file['filename']);
    }

    #[Title('Reports')]
    #[Layout('layouts.personal-pages', ['padding' => '0px', 'important' => '!important'])]
    public function render(ReportService $service)
    {
        $reports = $service->getReportsList();
        $reportData = $this->reportData;
        $selectedFile = $this->activeId ? $reports->firstWhere('report_id', $this->activeId) : null;
        $viewData = $service->getFormData($selectedFile, $reports);

        return view('livewire.pages.reports', collect($viewData)->merge(compact('reportData', 'selectedFile'))->all());
    }
}
