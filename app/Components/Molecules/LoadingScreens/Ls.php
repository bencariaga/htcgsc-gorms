<?php

namespace App\Components\Molecules\LoadingScreens;

use Illuminate\View\Component;

class Ls extends Component
{
    public function __construct(public ?string $id = null, public ?string $message = null) {}

    public function render()
    {
        return view('components.molecules.loading-screens.ls');
    }
}
