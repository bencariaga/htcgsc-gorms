<?php

namespace App\Data;

use App\Models\Report;
use Spatie\LaravelData\Data;

/**
 * @property-read int $report_id
 * @property-read string $title
 * @property-read string $start_date
 * @property-read string $end_date
 * @property-read string $data_category
 * @property-read string $file_output_format
 */
class ReportData extends Data
{
    public function __construct(
        public int $report_id,
        public string $title,
        public string $start_date,
        public string $end_date,
        public string $data_category,
        public string $file_output_format,
    ) {}

    public static function fromModel(Report $report): self
    {
        return new self(
            report_id: $report->report_id,
            title: $report->title,
            start_date: $report->start_date->format('Y-m-d'),
            end_date: $report->end_date->format('Y-m-d'),
            data_category: $report->data_category->value,
            file_output_format: $report->file_output_format->value,
        );
    }
}
