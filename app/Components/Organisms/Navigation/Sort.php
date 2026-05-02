<?php

namespace App\Components\Organisms\Navigation;

use App\Enums\NonDB\PaginationStyling;
use Illuminate\View\Component;

class Sort extends Component
{
    public array $options;

    public function __construct(public string $sortField, public string $sortDirection, public string $idColumn, public string $alphaColumn, public ?string $type = null)
    {
        $this->options = PaginationStyling::getSortOptions($this->idColumn, $this->alphaColumn);
    }

    public function render()
    {
        return view('components.organisms.navigation.sort');
    }
}
