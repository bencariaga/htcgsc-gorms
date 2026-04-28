<?php

namespace App\Components\GoogleForms;

use Illuminate\View\Component;

class Base extends Component
{
    public function __construct(public ?string $mode = null) {}

    public function render()
    {
        return view('components.google-forms.base');
    }
}
