<?php

namespace App\Components;

use App\Contracts\Colorable;
use App\Enums\NonDB\AuditLogsStyling;
use Illuminate\View\Component;

class StatusBadge extends Component
{
    public string $label;
    public string $classes;

    public function __construct(public mixed $status = null, public ?string $level = null)
    {
        [$this->label, $this->classes] = match (true) {
            $this->level !== null => [str($this->level)->upper(), AuditLogsStyling::getLevelClasses($this->level)],
            $this->status !== null => [
                $this->status instanceof \BackedEnum ? $this->status->value : $this->status,
                $this->status instanceof Colorable ? $this->status->color() : 'bg-slate-500 text-white border-slate-600'
            ],
            default => ['Unknown', 'bg-slate-500 text-white border-slate-600 dark:bg-slate-400 dark:text-white dark:border-slate-200'],
        };
    }

    public function render()
    {
        return view('components.atoms.utility.status-badge');
    }
}
