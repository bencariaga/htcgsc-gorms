<?php

namespace App\Components;

use Illuminate\View\Component;

class StudentGroup extends Component
{
    public function __construct(public mixed $item) {}

    public function render()
    {
        return view('components.atoms.buttons.action-buttons.student-group');
    }
}
