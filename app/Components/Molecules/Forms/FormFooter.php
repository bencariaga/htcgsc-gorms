<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class FormFooter extends Component
{
    public function __construct(public string $context = '', public string $backButtonText = 'Back', public string $loadingMessage = 'Going back...') {}

    public function render()
    {
        return view('components.molecules.forms.form-footer');
    }
}
