<?php

namespace App\Components\Organisms\Tables;

use Illuminate\View\Component;

class Table extends Component
{
    public function __construct(public array $columns = [], public mixed $items = [], public string $type = '') {}

    public function render()
    {
        return view('components.organisms.tables.table');
    }
}
