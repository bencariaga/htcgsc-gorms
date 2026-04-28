<?php

namespace App\Components\Atoms\Buttons\ActionButtons;

use Illuminate\View\Component;

class AppointmentGroup extends Component
{
    public function __construct(public mixed $item, public string $fullName) {}

    public function render()
    {
        return view('components.atoms.buttons.action-buttons.appointment-group');
    }
}
