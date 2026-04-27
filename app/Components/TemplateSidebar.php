<?php

namespace App\Components;

use Illuminate\{Support\Reflector, View\Component};

class TemplateSidebar extends Component
{
    public bool $isCreateSelected;

    public function __construct(
        public array $items = [],
        public mixed $files = [],
        public mixed $selectedFile = null,
        public ?string $title = 'Log Files',
        public ?string $sizeFormatted = null,
        public array $nameStrip = [],
        public ?string $fetchAction = 'fetchFile',
        public ?string $downloadAction = 'downloadFile',
        public ?string $deleteAction = null,
        public ?string $createNewAction = null,
        public string $idKey = 'name',
        public ?string $onFetch = null,
    ) {
        $this->isCreateSelected = $this->selectedFile === null;
    }

    public function getFileDetails(mixed $file): array
    {
        $id = data_get($file, $this->idKey);
        $isSelected = $this->selectedFile && data_get($this->selectedFile, $this->idKey) === $id;

        $displayName = str($id)->replace($this->nameStrip, '');

        if ($this->idKey !== 'name') {
            $displayName = data_get($file, 'name', data_get($file, 'title', $displayName));
        }

        $fileSize = $this->resolveFileSize($file);

        return [
            'isSelected' => $isSelected,
            'displayName' => $displayName,
            'fileSize' => $fileSize,
            'id' => $id,
            'delConfirmMsg' => "Are you sure you want to delete this item?\n\"{$displayName}\"",
        ];
    }

    private function resolveFileSize(mixed $file): string
    {
        if (Reflector::isCallable([$file, 'sizeFormatted'])) {
            return $file->sizeFormatted();
        }

        if ($size = data_get($file, 'sizeFormatted')) {
            return $size;
        }

        if ($updatedAt = data_get($file, 'updated_at')) {
            return $updatedAt->format('M. d, Y | h:i A');
        }

        return '';
    }

    public function render()
    {
        return view('components.molecules.sidebars.template-sidebar');
    }
}
