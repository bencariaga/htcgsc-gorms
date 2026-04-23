<?php

namespace App\Actions\Report;

use App\Actions\Data\RenderStatisticalData;
use App\Enums\{DataCategory, FileOutputFormat};
use App\{Exports\Report\Format, Models\Report, Support\BinaryFinder};
use Carbon\CarbonInterface;
use Illuminate\Support\{Facades\Log, Reflector};
use Maatwebsite\Excel\Facades\Excel;
use Spatie\Browsershot\Browsershot;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DownloadReport
{
    protected PrepareReportDownloadData $prepareData;

    protected RenderStatisticalData $stats;

    public function __construct(PrepareReportDownloadData $prepareData, RenderStatisticalData $stats)
    {
        $this->prepareData = $prepareData;
        $this->stats = $stats;
    }

    public function execute(Report $report): array
    {
        $category = $report->data_category;
        $format = $report->file_output_format;

        $now = now();

        $reportTitle = str($report->title ?? 'report')->slug();
        $categoryValue = str($category->value ?? $category)->slug();

        $dateTimeFormat = $now->format('Y-m-d_h-i-s-a');
        $extension = $format === FileOutputFormat::XLSX ? 'xlsx' : 'pdf';
        $filename = "{$reportTitle}_{$categoryValue}_{$dateTimeFormat}.{$extension}";

        $content = match ($format) {
            FileOutputFormat::XLSX => $this->generateExcel($report),
            FileOutputFormat::PDF => $this->generatePDF($report, $category, $now),
        };

        return compact('content', 'filename');
    }

    private function generateExcel(Report $report)
    {
        $query = $this->prepareData->handle($report->data_category);
        $title = $report->title ?? 'Report';
        $startDate = $report->start_date?->format('Y-m-d') ?? now()->format('Y-m-d');
        $endDate = $report->end_date?->format('Y-m-d') ?? now()->format('Y-m-d');

        return Excel::raw(new Format($query, $report->data_category, $title, $startDate, $endDate), \Maatwebsite\Excel\Excel::XLSX);
    }

    private function generatePDF(Report $report, DataCategory $category, CarbonInterface $now)
    {
        try {
            $query = $this->prepareData->handle($category);
            $results = $query->get();
            $stats = $this->stats->handle($report, $category, $now);
            $grid = $stats['grid'];
            $showMonthNum = true;

            $target = match ($category) {
                DataCategory::Users => 'users',
                DataCategory::Students => 'students',
                DataCategory::Appointments => 'form-submissions',
            };

            $targetView = "components.reports.{$target}";
            $html = view($targetView, compact('report', 'grid', 'results', 'showMonthNum'))->render();

            return $this->browser($html)->pdf();
        } catch (ProcessFailedException | \Exception $e) {
            Log::error('PDF Generation failed: ' . $e->getMessage());
            throw $e;
        }
    }

    private function browser(string $html): Browsershot
    {
        $browser = Browsershot::html($html);
        $names = ['Chrome', 'Node', 'Npm'];
        $binaries = collect($names)->combine(collect($names)->map(fn($name) => (string) str($name)->lower()))->toArray();

        foreach ($binaries as $method => $finder) {
            $setter = $method === 'Chrome' ? 'setChromePath' : "set{$method}Binary";

            if (Reflector::isCallable([$browser, $setter])) {
                $browser->$setter(BinaryFinder::$finder());
            }
        }

        if ($args = config('browsershot.chromium_arguments')) {
            $browser->addChromiumArguments($args);
        }

        return $browser->showBackground()->windowSize(816, 1248)->waitUntilNetworkIdle()->setDelay(1000)->setOption('preferCSSPageSize', true)->noSandbox();
    }
}
