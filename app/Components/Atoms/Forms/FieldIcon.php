<?php

namespace App\Components\Atoms\Forms;

use Illuminate\View\Component;

class FieldIcon extends Component
{
    public function __construct(public string $icon) {}

    public function render()
    {
        return view('components.atoms.forms.field-icon');
    }
}
