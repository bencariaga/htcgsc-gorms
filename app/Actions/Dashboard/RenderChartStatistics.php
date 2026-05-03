<?php

namespace App\Actions\Dashboard;

use App\Models\{Appointment, Student};
use Carbon\CarbonInterface;

class RenderChartStatistics
{
    public function handle(CarbonInterface $currentDate): array
    {
        $configurations = collect([15, 30])->map(fn ($days) => ['days' => $days, 'label' => " (From $days Days Ago)"]);
        $models = ['Form Submissions' => Appointment::class, 'Students Registered' => Student::class];

        $chartDefinitions = $configurations->crossJoin($models)->map(function ($pair) use ($currentDate, $models) {
            [$config, $model] = $pair;

            $title = collect($models)->flip()->get($model) . $config['label'];
            $dates = collect()->times(15, fn ($i) => $currentDate->copy()->subDays($config['days'] - $i));

            return compact('title', 'model', 'dates');
        })->all();

        return collect($chartDefinitions)->map(function ($chart) {
            $data = $chart['dates']->map(function ($date) use ($chart) {
                $label = $date->format('d');
                $year = $date->format('Y');
                $month_num = $date->format('m');
                $month_name = $date->format('F');
                $is_last_of_month = $date->day === $date->daysInMonth;
                $is_today = $date->isToday();
                $count = $chart['model']::whereDate('created_at', '<=', $date->toDateString())->count();

                return compact('label', 'year', 'month_num', 'month_name', 'is_last_of_month', 'is_today', 'count');
            })->values();

            $maxCount = $data->pluck('count')->max() ?: 1;
            $totalPoints = $data->count();
            $points = $data->map(fn ($record, $index) => [($index / ($totalPoints - 1)) * 400, 100 - (($record['count'] / $maxCount) * 100)]);
            $path = "M {$points[0][0]},{$points[0][1]}";

            $points->slice(0, -1)->each(function ($currentPoint, $index) use (&$path, $points, $data) {
                $nextPoint = $points[$index + 1];
                $curveIntensity = $data[$index]['count'] === $data[$index + 1]['count'] ? 0.3 : 0.15;
                $controlPoint1x = $currentPoint[0] + ($nextPoint[0] - $currentPoint[0]) * $curveIntensity;
                $controlPoint2x = $nextPoint[0] - ($nextPoint[0] - $currentPoint[0]) * $curveIntensity;
                $path .= " C $controlPoint1x,{$currentPoint[1]} $controlPoint2x,{$nextPoint[1]} {$nextPoint[0]},{$nextPoint[1]}";
            });

            $yAxisLabels = [(int) $maxCount, (int) ($maxCount / 2), 0];

            return collect($chart)->except('dates')->merge(compact('data', 'points', 'path', 'maxCount', 'yAxisLabels'))->toArray();
        })->all();
    }
}
