<?php

namespace App\Actions\Report;

use App\Models\Report;
use Illuminate\Support\{Carbon, Collection};

class RenderReport
{
    public function execute(Report $report): Collection
    {
        foreach (['User', 'Student', 'Appointment'] as $model) {
            $category = (string) str("DataCategory::{$model}")->upper()->plural();

            if ($report->data_category === $category) {
                $modelClass = "App\\Models\\{$model}";

                return $modelClass::whereBetween('created_at', [$report->start_date, $report->end_date])->get();
            }
        }

        return collect();
    }

    public function formatForFrontend(?Report $report): ?array
    {
        if (!$report) {
            return null;
        }

        $data = $report->toArray();

        foreach (['start', 'end'] as $key) {
            $data["{$key}_date"] = Carbon::parse($data["{$key}_date"])->format('Y-m-d');
        }

        return $data;
    }

    public function formatForStorage(array $data): array
    {
        foreach (['start', 'end'] as $key) {
            $field = "{$key}_date";

            if (collect($data)->has($field) && $data[$field]) {
                $data[$field] = Carbon::parse($data[$field])->format('Y-m-d');
            }
        }

        return $data;
    }
}
