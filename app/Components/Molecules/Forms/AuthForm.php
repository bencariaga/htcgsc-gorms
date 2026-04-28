<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class AuthForm extends Component
{
    public function __construct(public string $context, public string $submitAction) {}

    public function render()
    {
        return view('components.molecules.forms.auth-form');
    }
}
