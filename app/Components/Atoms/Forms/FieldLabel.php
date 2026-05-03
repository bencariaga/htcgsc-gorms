<?php

namespace App\Components\Atoms\Forms;

use Illuminate\View\Component;

class FieldLabel extends Component
{
    public function __construct(public string $label, public bool $required = false) {}

    public function render()
    {
        return view('components.atoms.forms.field-label');
    }
}
