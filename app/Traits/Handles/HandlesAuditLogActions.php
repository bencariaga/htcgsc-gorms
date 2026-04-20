<?php

namespace App\Traits\Handles;

use App\{Enums\NonDB\AuditLogsStyling, Services\ListType\AuditLogService};
use Opcodes\LogViewer\Facades\LogViewer;

/**
 * @property bool $isReloading
 * @property string $loadingAction
 * @property string $processingFileName
 * @property string $selectedFileName
 */
trait HandlesAuditLogActions
{
    public function fetchFile(string $fileName): void
    {
        $this->loadingAction = 'fetchFile';
        $this->processingFileName = $fileName;
        $this->getService()->clearMemoization();
        $this->selectedFileName = $fileName;
        $this->resetPage();
        $this->triggerGracefulRefresh();
    }

    public function refreshLogs(): void
    {
        $this->loadingAction = 'refreshLogs';
        $files = LogViewer::getFiles();
        $selectedFile = collect($files)->firstWhere('name', $this->selectedFileName) ?? $files->first();
        $this->getService()->clearCache($selectedFile);
        $this->triggerGracefulRefresh();
    }

    /**
     * @param  int|string  $page
     * @param  string  $pageName
     */
    public function updatePage($page, $pageName = 'page'): void
    {
        $this->setPage($page, $pageName);
        $this->triggerGracefulRefresh();
    }

    /**
     * @param  string  $pageName
     */
    public function previousPage($pageName = 'page'): void
    {
        $this->loadingAction = 'previousPage';
        $this->updatePage(max(1, (int) $this->getPage($pageName) - 1), $pageName);
    }

    /**
     * @param  string  $pageName
     */
    public function nextPage($pageName = 'page'): void
    {
        $this->loadingAction = 'nextPage';
        $this->updatePage((int) $this->getPage($pageName) + 1, $pageName);
    }

    /**
     * @param  int|string  $page
     * @param  string  $pageName
     */
    public function gotoPage($page, $pageName = 'page'): void
    {
        $this->loadingAction = 'gotoPage';
        $this->updatePage($page, $pageName);
    }

    public function downloadFile(string $fileName): mixed
    {
        $this->loadingAction = 'downloadFile';
        $this->processingFileName = $fileName;
        $this->dispatch('notify', type: 'success', message: "Log file \"<strong>{$fileName}</strong>\" has been <strong>downloaded</strong> successfully.");

        return $this->getService()->downloadFile($fileName);
    }

    public function getPlainText(mixed $item): string
    {
        return $this->getService()->getPlainText($item);
    }

    public function getMarkdown(mixed $item): string
    {
        return $this->getService()->getMarkdown($item);
    }

    public function triggerGracefulRefresh(): void
    {
        $this->isReloading = true;
    }

    public function checkReloadStatus(): void
    {
        if ($this->isReloading) {
            $this->isReloading = false;
            $this->loadingAction = '';
            $this->dispatch('refresh-page');
        }
    }

    public function getLoadingMessage(): string
    {
        return AuditLogsStyling::getLoadingMessage($this->loadingAction);
    }

    protected function getService(): AuditLogService
    {
        return app(AuditLogService::class);
    }
}
