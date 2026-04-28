<?php

namespace App\Components\Atoms\Utility;

use Illuminate\View\Component;

class Spinner extends Component
{
    public function __construct(public bool $darkMode = true) {}

    public function render()
    {
        return view('components.atoms.utility.spinner');
    }
}
