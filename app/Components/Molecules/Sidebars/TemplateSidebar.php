<?php

namespace App\Components\Molecules\Sidebars;

use Illuminate\{Support\Number, View\Component};
use ReflectionClass;

class TemplateSidebar extends Component
{
    public bool $isCreateSelected;

    public function __construct(public array $items = [], public mixed $files = [], public mixed $selectedFile = null, public ?string $title = null, public ?string $sizeFormatted = null, public array $nameStrip = [], public ?string $fetchAction = 'fetchFile', public ?string $downloadAction = 'downloadFile', public ?string $deleteAction = null, public ?string $createNewAction = null, public string $idKey = 'name', public ?string $onFetch = null)
    {
        $this->isCreateSelected = $this->selectedFile === null;
    }

    protected function getMappedFiles(): array
    {
        $files = collect($this->files);
        $selectedId = $this->selectedFile ? data_get($this->selectedFile, $this->idKey) : null;

        return $files->map(function ($file) use ($selectedId) {
            $id = data_get($file, $this->idKey);
            $isSelected = $selectedId !== null && $id === $selectedId;
            $displayName = $file->title ?? (string) $id;

            foreach ($this->nameStrip as $strip) {
                $displayName = str($displayName)->replace($strip, '')->toString();
            }

            $formatted = data_get($file, 'sizeFormatted');
            $reflection = new ReflectionClass($file);
            $canCallMethod = $reflection->hasMethod('sizeFormatted') && $reflection->getMethod('sizeFormatted')->isPublic();

            $rawSize = data_get($file, 'size');
            $formattedRaw = $rawSize ? Number::fileSize($rawSize, precision: 2) : null;

            $fileSize = $this->sizeFormatted ?? $formatted ?? ($canCallMethod ? $file->sizeFormatted() : null) ?? $formattedRaw;

            $updatedAt = data_get($file, 'updated_at');
            $delConfirmMsg = "Are you sure you want to delete \"{$displayName}\"?";

            return compact('id', 'isSelected', 'displayName', 'fileSize', 'updatedAt', 'delConfirmMsg');
        })->values()->all();
    }

    public function render()
    {
        return view('components.molecules.sidebars.template-sidebar', ['mappedFiles' => $this->getMappedFiles()]);
    }
}
