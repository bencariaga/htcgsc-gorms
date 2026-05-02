<?php

namespace App\Components\Atoms\Buttons\ButtonGroups;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\View\Component;

class FilterButtonGroup extends Component
{
    public array $settings;

    public function __construct(public string $type, public string $filter = 'All', public bool $sidebarOpen = false)
    {
        $this->settings = PaginationStyling::getLayoutSettings($this->type);
    }

    public function render()
    {
        return view('components.atoms.buttons.button-groups.filter-button-group');
    }
}
