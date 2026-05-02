<?php

namespace App\Actions\Data;

use App\{Enums\DataCategory, Models\Report};
use App\Traits\Handles\HandlesStatistics;
use Carbon\CarbonInterface;
use Illuminate\Support\Carbon;

class RenderStatisticalData
{
    use HandlesStatistics;

    public function handle(Report $report, DataCategory $category, CarbonInterface $now): array
    {
        $grid = collect(['start_date' => 'From', 'end_date' => 'To'])->map(fn ($suffix, $field) => [
            'label' => "Included Registered<br>{$category->value} {$suffix}",
            'value' => Carbon::parse($report->{$field})->format('M. d, Y'),
        ])->values();

        match ($category) {
            DataCategory::Users => app(Statistics\RenderUserStatistics::class)->handle($grid, $now),
            DataCategory::Students => app(Statistics\RenderStudentStatistics::class)->handle($grid, $now),
            DataCategory::Appointments => app(Statistics\RenderAppointmentStatistics::class)->handle($grid, $now),
        };

        return ['grid' => $this->formatGrid($grid)->toArray()];
    }
}
