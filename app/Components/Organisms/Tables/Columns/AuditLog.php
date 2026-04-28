<?php

namespace App\Components\Organisms\Tables\Columns;

use Illuminate\View\Component;

class AuditLog extends Component
{
    public function __construct(public mixed $item, public string $level = 'info') {}

    public function render()
    {
        return view('components.organisms.tables.columns.audit-log');
    }
}
