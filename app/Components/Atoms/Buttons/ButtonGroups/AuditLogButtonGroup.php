<?php

namespace App\Components\Atoms\Buttons\ButtonGroups;

use App\Enums\NonDB\AuditLogsStyling;
use Illuminate\View\Component;

class AuditLogButtonGroup extends Component
{
    public array $config;

    public string $baseClasses;

    public string $hoverClass;

    public function __construct(public string $action, public ?string $click = null, public ?string $activeCondition = null, public ?string $activeText = null)
    {
        $this->config = AuditLogsStyling::getButtonConfig($this->action);
        $this->baseClasses = 'relative h-[48px] px-6 text-sm font-bold uppercase tracking-widest rounded-xl transition-all duration-300 border-2 overflow-hidden whitespace-nowrap shadow-sm';
        $this->hoverClass = AuditLogsStyling::getHoverClasses($this->action);
    }

    public function render()
    {
        return view('components.atoms.buttons.button-groups.audit-log-button-group');
    }
}
