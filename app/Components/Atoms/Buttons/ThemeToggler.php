<?php

namespace App\Components\Atoms\Buttons;

use Illuminate\View\Component;

class ThemeToggler extends Component
{
    public function render()
    {
        return view('components.atoms.buttons.theme-toggler');
    }
}
