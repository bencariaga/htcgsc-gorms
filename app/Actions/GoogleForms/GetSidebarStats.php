<?php

namespace App\Actions\GoogleForms;

use App\Models\Appointment;
use Illuminate\Support\Str;

class GetSidebarStats
{
    public function execute(): array
    {
        $formats = ['Day' => ['format' => 'jS \d\a\y', 'prefix' => 'On the'], 'Month' => ['format' => 'F', 'prefix' => 'In'], 'Year' => ['format' => 'Y', 'prefix' => 'In']];
        $stats = [['TOTAL', 'SUBMITS', Appointment::query()]];

        foreach ($formats as $segment => $data) {
            $method = "where{$segment}";
            $property = Str::lower($segment);
            $stats[] = [$data['prefix'], now()->format($data['format']), Appointment::$method('created_at', now()->$property)];
        }

        return collect($stats)->map(function ($stat) {
            [$prefix, $label, $query] = $stat;
            $span = '<span class="text-black dark:text-white">%s</span>';
            $replaced = Str::replace('%s', ($prefix === 'TOTAL' ? $prefix : $label), $span);
            $formattedLabel = ($prefix === 'TOTAL') ? "{$replaced} {$label}" : "{$prefix} {$replaced}";

            return ['label' => $formattedLabel, 'value' => $query->count()];
        })->all();
    }
}
