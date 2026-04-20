<?php

namespace App\Actions\Report;

use App\Models\Report;
use Illuminate\{Support\Carbon, Validation\ValidationException};

class SaveReport
{
    public function execute(array $data): Report
    {
        $reportId = $data['report_id'] ?? null;

        if (!$reportId && Report::count() >= 99) {
            throw ValidationException::withMessages(['report' => 'You cannot create more than 99 reports.']);
        }

        $sanitized = collect($data)->map(fn ($value) => $value === '' ? null : $value);

        $formatted = $sanitized->map(function ($value, $key) {
            if (collect(['start_date', 'end_date'])->contains($key) && $value) {
                return Carbon::parse($value)->toDateString();
            }

            return $value;
        })->toArray();

        return Report::updateOrCreate(['report_id' => $reportId], $this->mapFields($formatted));
    }

    private function mapFields(array $data): array
    {
        return [
            'title' => $data['title'] ?? null,
            'start_date' => $data['start_date'] ?? null,
            'end_date' => $data['end_date'] ?? null,
            'data_category' => $data['data_category'] ?? null,
            'file_output_format' => $data['file_output_format'] ?? null,
        ];
    }
}
