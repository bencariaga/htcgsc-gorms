<?php

namespace App\Services\ListType;

use App\Actions\AuditLog\{ClearAuditLogData, DownloadAuditLog, GetAuditLogs, GetMarkdownAuditLog, GetPlainTextAuditLog};
use Illuminate\Pagination\LengthAwarePaginator;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class AuditLogService
{
    public function __construct(protected GetAuditLogs $getLogsAction, protected DownloadAuditLog $downloadAction, protected GetPlainTextAuditLog $getPlainTextAction, protected GetMarkdownAuditLog $getMarkdownAction, protected ClearAuditLogData $clearAction) {}

    public function getLogs(mixed $selectedFile, string $search, string $sortField, string $sortDirection, int|string $perPage, string $filter = 'All', int $page = 1): LengthAwarePaginator
    {
        return $this->getLogsAction->handle($selectedFile, $search, $sortField, $sortDirection, $perPage, $filter, $page);
    }

    public function downloadFile(string $fileName): BinaryFileResponse
    {
        return $this->downloadAction->handle($fileName);
    }

    public function getPlainText(mixed $item): string
    {
        return $this->getPlainTextAction->handle($item);
    }

    public function getMarkdown(mixed $item): string
    {
        return $this->getMarkdownAction->handle($item);
    }

    public function clearMemoization(): void
    {
        GetAuditLogs::clearMemoization();
    }

    public function clearCache(mixed $selectedFile): void
    {
        $this->clearAction->clearCache($selectedFile);
        $this->clearMemoization();
    }

    public function clearMismatchedLoggingFiles(): void
    {
        $this->clearAction->clearMismatchedLoggingFiles();
    }
}
