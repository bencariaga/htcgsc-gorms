<?php

namespace App\Components\Atoms\Inputs;

use Illuminate\View\Component;

class AuthInput extends Component
{
    public function __construct(public ?string $label = null, public ?string $placeholder = null, public string $model = '', public string $icon = 'fa-lock', public string $type = 'text', public bool $required = false) {}

    public function render()
    {
        return view('components.atoms.inputs.auth-input');
    }
}
