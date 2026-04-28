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
        $this->baseClasses = 'relative h-[48px] px-3 text-sm font-bold tracking-normal border-none transition-all duration-300 overflow-hidden whitespace-nowrap';
        $this->hoverClass = AuditLogsStyling::getHoverClasses($this->action);
    }

    public function render()
    {
        return view('components.atoms.buttons.button-groups.audit-log-button-group');
    }
}
