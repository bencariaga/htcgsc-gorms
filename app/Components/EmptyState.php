<?php

namespace App\Components;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\View\Component;

class EmptyState extends Component
{
    public string $displayTitle;

    public function __construct(public string $type, ?string $displayTitle = null)
    {
        $alias = PaginationStyling::getAlias($this->type);
        $this->displayTitle = $displayTitle ?? str($alias)->plural();
    }

    public function render()
    {
        return view('components.organisms.tables.empty-state');
    }
}
