<?php

namespace App\Components\Atoms\Utility;

use Illuminate\View\Component;

class DigitalClock extends Component
{
    public string $time;

    public function __construct()
    {
        $this->time = now()->format('M. d, Y | h:i:s A');
    }

    public function render()
    {
        return view('components.atoms.utility.digital-clock');
    }
}
