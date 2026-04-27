<?php

namespace App\Components;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\View\Component;

class Search extends Component
{
    public string $width;

    public function __construct(public string $type = 'default')
    {
        $this->width = PaginationStyling::getSearchWidth($this->type);
    }

    public function render()
    {
        return view('components.organisms.navigation.search');
    }
}
