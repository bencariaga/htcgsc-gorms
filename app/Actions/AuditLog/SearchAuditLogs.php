<?php

namespace App\Actions\AuditLog;

use Illuminate\Support\{Collection, Str};

class SearchAuditLogs
{
    public function handle(Collection $logs, string $search): Collection
    {
        return Str::of($search)->isEmpty() ? $logs : $logs->filter(fn ($log) => Str::contains($log->message, $search, true));
    }
}
