<?php

namespace App\Components\Templates;

use Illuminate\View\Component;

class PersonalPages extends Component
{
    public function __construct(public string $title = 'Dashboard', public string $padding = '20px', public string $important = '', public ?string $type = null) {}

    public function render()
    {
        return view('components.templates.personal-pages');
    }
}
