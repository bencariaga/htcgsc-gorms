<?php

namespace App\Actions\AuditLog;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\Support\{Collection, Str};

class FilterAuditLogs
{
    public function handle(Collection $logs, string $search, string $filter): Collection
    {
        $options = PaginationStyling::getFilters('audit-log')['options'];

        return $logs->filter(function ($log) use ($search, $filter, $options) {
            $matchesSearch = Str::of($search)->isEmpty() || Str::contains(Str::lower($log->message), Str::lower($search));

            $matchesFilter = match ($filter) {
                $options[1], $options[2], $options[3], $options[4] => Str::lower($log->level) === Str::lower($filter),
                default => true,
            };

            return $matchesSearch && $matchesFilter;
        });
    }
}
