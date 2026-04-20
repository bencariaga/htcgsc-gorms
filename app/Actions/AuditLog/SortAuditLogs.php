<?php

namespace App\Actions\AuditLog;

use Illuminate\Support\Collection;

class SortAuditLogs
{
    public function handle(Collection $logs, string $sortField, string $sortDirection): Collection
    {
        return $sortDirection === 'desc' ? $logs->sortByDesc($sortField) : $logs->sortBy($sortField);
    }
}
