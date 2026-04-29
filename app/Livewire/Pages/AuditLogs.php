<?php

namespace App\Livewire\Pages;

use App\Livewire\Bases\BaseListType;
use App\Traits\{Handles\HandlesAuditLogActions, Has\HasAppInformation};
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\{Title, Url};
use Opcodes\LogViewer\Facades\LogViewer;

#[Title('Audit Logs')]
class AuditLogs extends BaseListType
{
    use HandlesAuditLogActions, HasAppInformation;

    #[Url(as: 'file')]
    public ?string $selectedFileName = null;

    public ?string $processingFileName = null;

    public string $type = 'audit-logs';

    public bool $isReloading = false;

    public string $loadingAction = '';

    protected ?string $view = 'livewire.pages.audit-logs';

    protected ?string $key = 'logs';

    protected function defaultSortField(): string
    {
        return 'datetime';
    }

    public function updated(string $property, mixed $value)
    {
        parent::updated($property, $value);

        if ($property === 'filter') {
            $this->loadingAction = 'filter';
        }

        $properties = ['filter', 'page', 'perPage', 'search', 'sortField'];

        if ($this->type === 'audit-logs' && collect($properties)->contains($property)) {
            $this->triggerGracefulRefresh();
        }
    }

    public function render()
    {
        $service = $this->getService();

        $service->clearMismatchedLoggingFiles();

        $files = collect(LogViewer::getFiles())->filter(fn ($file) => $file->name !== 'laravel.log')->values();

        $selectedFile = $files->firstWhere('name', $this->selectedFileName) ?? $files->first();

        $viewPath = $this->view;

        /** @var mixed $view */
        $view = view($viewPath, [$this->key => $service->getLogs($selectedFile, $this->search, $this->sortField, $this->sortDirection, $this->perPage, $this->filter, $this->getPage()), 'user' => Auth::user()?->loadMissing('person'), 'files' => $files, 'selectedFile' => $selectedFile, 'processingFileName' => $this->processingFileName, 'appInfo' => $this->getAppInfo()]);

        return $view->layout('layouts.personal-pages', ['padding' => '0px', 'important' => '!important', 'type' => $this->getType()]);
    }
}
