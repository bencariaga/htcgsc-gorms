<?php

namespace App\Components\Molecules\ToastNotifications;

use Illuminate\View\Component;

class TemplateTn extends Component
{
    public function __construct(public bool $darkMode = true) {}

    public function render()
    {
        return view('components.molecules.toast-notifications.template-tn');
    }
}
