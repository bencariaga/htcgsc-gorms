<?php

namespace App\Components\Molecules\LoadingScreens;

use Illuminate\View\Component;

class LsLivewire extends Component
{
    public function __construct(public ?string $id = null, public string $message = 'Processing...') {}

    public function render()
    {
        return view('components.molecules.loading-screens.ls-livewire');
    }
}
