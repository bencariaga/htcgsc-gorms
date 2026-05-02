<?php

namespace App\Components\Organisms\Navigation;

use Illuminate\View\Component;

class PaginationGroup extends Component
{
    public function __construct(public mixed $items, public string $type, public mixed $perPage, public string $sortField, public string $sortDirection, public string $idColumn = 'id', public string $alphaColumn = 'name') {}

    public function render()
    {
        return view('components.organisms.navigation.pagination-group');
    }
}
