<?php

namespace App\Actions\Data\Statistics;

use App\{Traits\Handles\HandlesStatistics, Models\User};
use App\Enums\{AccountStatus, NonDB\ReportDownloadDataStyling, PersonType};
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class RenderUserStatistics
{
    use HandlesStatistics;

    public function handle(Collection $grid, CarbonInterface $now): void
    {
        $admin = User::whereHas('person', fn ($q) => $q->where('type', PersonType::Administrator))->with('person')->first();

        $grid->push(['label' => 'Current Administrator', 'value' => $admin?->person->full_name ?? 'N/A']);

        $all = User::query()->toBase()->select('account_status', 'created_at')->get();

        $mapping = [
            'total' => [null, ReportDownloadDataStyling::TOTAL_EMPLOYEES],
            'active' => [AccountStatus::Active->value, ReportDownloadDataStyling::TOTAL_ACTIVE_EMPLOYEES],
            'inactive' => [AccountStatus::Inactive->value, ReportDownloadDataStyling::TOTAL_INACTIVE_EMPLOYEES],
        ];

        $this->pushStatsToGrid($grid, $all, $mapping, $now, 'account_status');
    }
}
