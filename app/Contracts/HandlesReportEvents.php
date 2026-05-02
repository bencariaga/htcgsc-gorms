<?php

namespace App\Contracts;

use App\Models\Report;

interface HandlesReportEvents
{
    public function created(Report $report): void;
}
