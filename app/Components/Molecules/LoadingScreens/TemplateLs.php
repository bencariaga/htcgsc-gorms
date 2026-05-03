<?php

namespace App\Components\Molecules\LoadingScreens;

use Illuminate\View\Component;

class TemplateLs extends Component
{
    public function __construct(public bool $darkMode = true, public string $bladeViewName = '', public ?string $message = null) {}

    public function render()
    {
        return view('components.molecules.loading-screens.template-ls');
    }
}
