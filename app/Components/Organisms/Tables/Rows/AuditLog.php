<?php

namespace App\Components\Organisms\Tables\Rows;

use Illuminate\View\Component;

class AuditLog extends Component
{
    public string $level;

    public function __construct(public mixed $item)
    {
        $this->level = data_get($this->item, 'level', 'INFO');
    }

    public function render()
    {
        return view('components.organisms.tables.rows.audit-log');
    }
}
