<?php

namespace App\Components\Organisms\Tables\Columns;

use Illuminate\View\Component;

class Appointment extends Component
{
    public function __construct(public mixed $item, public mixed $person = null, public mixed $cellStyling = null, public ?string $bookedTime = null, public ?string $modalBookedTime = null, public bool $isReschedulable = false) {}

    public function render()
    {
        return view('components.organisms.tables.columns.appointment');
    }
}
