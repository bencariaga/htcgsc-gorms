<?php

namespace App\Components\Organisms\Tables\Columns;

use Illuminate\View\Component;

class Student extends Component
{
    public function __construct(public mixed $item, public mixed $person = null, public mixed $cellStyling = null, public string $referrer = '—', public mixed $latestAppointment = null) {}

    public function render()
    {
        return view('components.organisms.tables.columns.student');
    }
}
