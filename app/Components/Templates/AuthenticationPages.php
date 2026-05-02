<?php

namespace App\Components\Templates;

use Illuminate\View\Component;

class AuthenticationPages extends Component
{
    public function __construct(public ?string $title = null, public string $maxWidth = '450px') {}

    public function render()
    {
        return view('components.templates.authentication-pages');
    }
}
