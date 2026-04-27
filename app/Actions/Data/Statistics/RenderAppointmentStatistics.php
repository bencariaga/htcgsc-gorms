<?php

namespace App\Actions\Data\Statistics;

use App\{Traits\Handles\HandlesStatistics, Models\Appointment};
use App\Enums\{AppointmentStatus, NonDB\ReportDownloadDataStyling};
use Carbon\CarbonInterface;
use Illuminate\Support\Collection;

class RenderAppointmentStatistics
{
    use HandlesStatistics;

    public function handle(Collection $grid, CarbonInterface $now): void
    {
        $all = Appointment::query()->toBase()->select('appointment_status', 'created_at')->get();

        $mapping = [
            'total' => [null, ReportDownloadDataStyling::TOTAL_SUBMISSIONS],
            'done' => [AppointmentStatus::Done->value, ReportDownloadDataStyling::DONE_APPOINTMENTS],
            'scheduled' => [AppointmentStatus::Scheduled->value, ReportDownloadDataStyling::SCHEDULED_APPOINTMENTS],
            'cancelled' => [AppointmentStatus::Cancelled->value, ReportDownloadDataStyling::CANCELLED_APPOINTMENTS],
        ];

        $this->pushStatsToGrid($grid, $all, $mapping, $now, 'appointment_status');
    }
}
