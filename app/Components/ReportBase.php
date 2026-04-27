<?php

namespace App\Components;

use Illuminate\Support\Arr;
use Illuminate\View\Component;

class ReportBase extends Component
{
    public function __construct(public mixed $report, public mixed $grid, public mixed $slot = null) {}

    public function getGridItemDetails(mixed $item): array
    {
        $item = (array) $item;
        $label = Arr::accessible($item['label'] ?? null) ? (string) collect($item['label'])->implode(' ') : (string) ($item['label'] ?? '');
        $value = Arr::accessible($item['value'] ?? null) ? (string) collect($item['value'])->implode(', ') : (string) ($item['value'] ?? '');

        return [
            'label' => $label,
            'value' => $value,
            'icon' => $item['icon'] ?? null,
            'colors' => $item['colors'] ?? [],
            'subtext' => $item['subtext'] ?? null,
        ];
    }

    public function render()
    {
        return view('components.reports.base');
    }
}
