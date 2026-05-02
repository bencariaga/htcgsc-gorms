<?php

namespace App\Observers;

use App\{Contracts\HandlesReportEvents, Data\ReportData, Models\Report};
use Illuminate\Support\Facades\Log;

class ReportObserver implements HandlesReportEvents
{
    public function created(Report $report): void
    {
        Log::info('Report created.', ReportData::fromModel($report)->toArray());
    }
}
