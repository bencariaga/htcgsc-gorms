<?php

namespace App\Components\Reports;

use Illuminate\{Support\Arr, View\Component};

class Base extends Component
{
    public function __construct(public mixed $report, public mixed $grid, public mixed $slot = null) {}

    public function getGridItemDetails(mixed $item): array
    {
        $item = (array) $item;

        $label = Arr::accessible($item['label'] ?? null) ? (string) collect($item['label'])->implode(' ') : (string) ($item['label'] ?? '');

        $value = Arr::accessible($item['value'] ?? null) ? (string) collect($item['value'])->implode(', ') : (string) ($item['value'] ?? '');

        $icon = $item['icon'] ?? null;

        $colors = $item['colors'] ?? [];

        $subtext = $item['subtext'] ?? null;

        return compact('label', 'value', 'icon', 'colors', 'subtext');
    }

    public function render()
    {
        return view('components.reports.base');
    }
}
