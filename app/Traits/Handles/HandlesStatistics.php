<?php

namespace App\Traits\Handles;

use App\Enums\NonDB\ReportDownloadDataStyling;
use Carbon\CarbonInterface;
use Illuminate\Support\{Carbon, Collection};

trait HandlesStatistics
{
    protected function pushStatsToGrid(Collection $grid, Collection $data, array $mapping, CarbonInterface $now, ?string $field = null): void
    {
        foreach ($mapping as $key => $params) {
            [$status, $enum] = $params;
            $searchField = $params[2] ?? $field;
            $filter = fn ($item) => $key === 'total' ? true : data_get($item, $searchField) === $status;
            $currentData = $data->filter($filter);
            $yearlyData = $currentData->filter(fn ($item) => Carbon::parse(data_get($item, 'created_at'))->year === $now->year);
            $grid->push(['type' => $enum, 'value' => (string) $currentData->count(), 'subtext' => $enum->generateSubtext($yearlyData->count())]);
        }
    }

    protected function formatGrid(Collection $grid): Collection
    {
        return $grid->map(function ($item) {
            $base = collect(['icon', 'iconSize', 'colors', 'subtext', 'type'])->mapWithKeys(fn ($key) => [$key => null])->merge($item)->all();

            if ($base['type'] instanceof ReportDownloadDataStyling) {
                $base['icon'] = $base['type']->icon();
                $base['iconSize'] = $base['type']->iconSize();
                $base['colors'] = $base['type']->colors();
                $base['label'] = $base['type']->preFormattedLabel();
            }

            return $base;
        });
    }
}
