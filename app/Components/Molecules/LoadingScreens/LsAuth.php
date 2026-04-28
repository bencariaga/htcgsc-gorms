<?php

namespace App\Components\Molecules\LoadingScreens;

use Illuminate\View\Component;

class LsAuth extends Component
{
    public function __construct(public string $target, public string $message = 'Processing...') {}

    public function render()
    {
        return view('components.molecules.loading-screens.ls-auth');
    }
}
