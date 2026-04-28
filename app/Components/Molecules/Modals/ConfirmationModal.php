<?php

namespace App\Components\Molecules\Modals;

use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public function __construct(public string $id, public mixed $param = null) {}

    public function render()
    {
        return view('components.molecules.modals.confirmation-modal');
    }
}
