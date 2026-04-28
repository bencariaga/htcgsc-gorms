<?php

namespace App\Components\Molecules\Forms;

use Illuminate\View\Component;

class FormHeader extends Component
{
    public function __construct(public string $context = '', public ?string $title = null, public ?string $form = null, public ?string $description = null, public ?string $identifier = null) {}

    public function render()
    {
        return view('components.molecules.forms.form-header');
    }
}
