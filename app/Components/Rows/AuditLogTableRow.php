<?php

namespace App\Components\Rows;

use Illuminate\View\Component;

class AuditLogTableRow extends Component
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
