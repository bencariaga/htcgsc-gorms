<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class SuffixDropdown extends Component
{
    public function __construct(public array $suffixes) {}

    public function render()
    {
        return view('components.molecules.forms.suffix-dropdown');
    }
}
