<?php

namespace App\Actions\AuditLog;

use Illuminate\{Pagination\LengthAwarePaginator, Support\Collection, Support\Facades\Cache};

class GetAuditLogs
{
    protected static ?Collection $memoizedLogs = null;

    public function __construct(protected SearchAuditLogs $searchAction, protected FilterAuditLogs $filterAction, protected SortAuditLogs $sortAction, protected PrepareAuditLogData $prepareAction, protected GetMarkdownAuditLog $markdownAction) {}

    public function handle(mixed $selectedFile, string $search, string $sortField, string $sortDirection, int|string $perPage, string $filter = 'All', int $page = 1): LengthAwarePaginator
    {
        if (!$selectedFile) {
            return new LengthAwarePaginator([], 0, $perPage === 'all' ? 10 : (int) $perPage);
        }

        if (static::$memoizedLogs === null) {
            ini_set('memory_limit', '512M');
            set_time_limit(60);

            $cacheKey = "audit_logs_{$selectedFile->identifier}";

            static::$memoizedLogs = Cache::remember($cacheKey, now()->addMinutes(60), fn () => collect($selectedFile->logs()->scan()->get()));
        }

        $logs = static::$memoizedLogs;

        $logs = $this->searchAction->handle($logs, $search);
        $logs = $this->filterAction->handle($logs, $search, $filter);
        $logs = $this->sortAction->handle($logs, $sortField, $sortDirection);

        $total = $logs->count();

        $limit = ($perPage === 'all') ? $total : (int) $perPage;

        $paginator = new LengthAwarePaginator($logs->forPage($page, $limit)->values()->map(fn ($item) => $this->prepareAction->handle($item)), $total, $limit, $page, ['path' => LengthAwarePaginator::resolveCurrentPath()]);

        $paginator->getCollection()->transform(function ($item) {
            $item['markdown'] = $this->markdownAction->handle($item['item']);

            return $item;
        });

        return $paginator;
    }

    public static function clearMemoization(): void
    {
        static::$memoizedLogs = null;
    }
}
