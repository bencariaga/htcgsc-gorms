<?php

namespace App\Components\Atoms\Utility;

use App\Contracts\Colorable;
use Illuminate\{Support\Reflector, View\Component};

class StatusDot extends Component
{
    public string $color;

    public string $label;

    public function __construct(public mixed $status)
    {
        $colorClasses = $this->status instanceof Colorable ? $this->status->color() : 'bg-slate-500';
        $this->color = collect(explode(' ', $colorClasses))->first(fn ($c) => str_starts_with($c, 'bg-')) ?? 'bg-slate-500';
        $this->label = Reflector::isCallable([$this->status, 'label']) ? $this->status->label() : ($this->status instanceof \BackedEnum ? $this->status->value : $this->status);
    }

    public function render()
    {
        return view('components.atoms.utility.status-dot');
    }
}
