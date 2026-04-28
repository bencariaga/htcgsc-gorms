<?php

namespace App\Components\Atoms\Buttons\ButtonGroups;

use App\Enums\NonDB\PageButtonStyling;
use Illuminate\View\Component;

class PageButtonGroup extends Component
{
    public PageButtonStyling $styleEnum;

    public bool $isHeader;

    public function __construct(public string $variant = 'sidebar')
    {
        $this->styleEnum = PageButtonStyling::tryFrom($this->variant) ?? PageButtonStyling::SIDEBAR;
        $this->isHeader = $this->styleEnum === PageButtonStyling::HEADER;
    }

    public function render()
    {
        return view('components.atoms.buttons.button-groups.page-button-group');
    }
}
