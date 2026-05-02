<?php

namespace App\Components\Organisms\Tables;

use Illuminate\View\Component;

class TableColumn extends Component
{
    public function __construct(public array $columns) {}

    public function render()
    {
        return view('components.organisms.tables.table-column');
    }
}
