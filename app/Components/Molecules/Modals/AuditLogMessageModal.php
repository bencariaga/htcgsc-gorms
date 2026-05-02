<?php

namespace App\Components\Molecules\Modals;

use Illuminate\View\Component;

class AuditLogMessageModal extends Component
{
    public function __construct(public string $id) {}

    public function render()
    {
        return view('components.molecules.modals.audit-log-message-modal');
    }
}
