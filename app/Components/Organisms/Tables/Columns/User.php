<?php

namespace App\Components\Organisms\Tables\Columns;

use Illuminate\View\Component;

class User extends Component
{
    public function __construct(public mixed $item, public mixed $person = null, public mixed $cellStyling = null) {}

    public function render()
    {
        return view('components.organisms.tables.columns.user');
    }
}
