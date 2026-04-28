<?php

namespace App\Components\Molecules\Sidebars;

use Illuminate\View\Component;

class TemplateSidebar extends Component
{
    public bool $isCreateSelected;

    public function __construct(
        public array $items = [],
        public mixed $files = [],
        public mixed $selectedFile = null,
        public ?string $title = null,
        public ?string $sizeFormatted = null,
        public array $nameStrip = [],
        public ?string $fetchAction = 'fetchFile',
        public ?string $downloadAction = 'downloadFile',
        public ?string $deleteAction = null,
        public ?string $createNewAction = null,
        public string $idKey = 'name',
        public ?string $onFetch = null
    ) {
        $this->isCreateSelected = $this->selectedFile === null;
    }

    public function render()
    {
        return view('components.molecules.sidebars.template-sidebar');
    }
}
