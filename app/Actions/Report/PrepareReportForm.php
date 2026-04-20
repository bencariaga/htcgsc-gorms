<?php

namespace App\Actions\Report;

use App\{Enums\NonDB\ReportFormStyling, Models\Report, Support\Json};
use Illuminate\Support\Collection;

class PrepareReportForm
{
    public function execute(?Report $selectedReport, Collection $reports, ?array $formattedReport): array
    {
        $types = ['categories', 'formats', 'actions', 'fields'];
        $styling = [];

        foreach ($types as $type) {
            $method = 'get' . str($type)->ucfirst();
            $styling[$type] = ReportFormStyling::$method();
        }

        extract($styling);

        $keys = ['report_id', 'title', 'data_category', 'start_date', 'end_date', 'file_output_format'];

        $initialState = Json::encode(collect($keys)->mapWithKeys(fn ($key) => [$key => $key === 'report_id' ? null : ''])->all(), JSON_THROW_ON_ERROR);

        $preloadedData = $selectedReport ? Json::encode($formattedReport, JSON_THROW_ON_ERROR) : 'null';

        $actionHeader = $selectedReport !== null ? 'Editing' : 'Creating New';

        $jsFields = Json::encode(collect($fields)->keys()->all());

        $jsFormats = Json::encode(collect($formats)->pluck('label')->all());

        $today = now()->format('Y-m-d');

        $actions = $this->processActions($actions, $selectedReport);

        $files = $reports;

        return compact('categories', 'formats', 'actions', 'fields', 'initialState', 'preloadedData', 'actionHeader', 'jsFields', 'jsFormats', 'today', 'files');
    }

    private function processActions(array $actions, ?Report $selectedReport): Collection
    {
        return collect($actions)->map(function ($action) use ($selectedReport) {
            $actionKey = str($action['label'])->snake()->lower()->toString();

            $displayText = ($selectedReport !== null && $actionKey === 'generate_report') ? 'Regenerate Report' : $action['label'];

            $clickAction = match ($actionKey) {
                'download_report' => '$wire.download(form.report_id)',
                'reset_to_default' => 'resetToDefault',
                default => $action['click'] ?? '',
            };

            return collect($action)->merge(compact('actionKey', 'displayText', 'clickAction'))->toArray();
        });
    }
}
