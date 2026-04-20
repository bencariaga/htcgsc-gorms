<?php

namespace App\Enums\NonDB;

use App\{Enums\DataCategory};

enum ReportFormStyling
{
    public static function getCategories(): array
    {
        $categories = ['' => 'Select category.'];

        foreach (DataCategory::cases() as $case) {
            $categories[$case->value] = $case->value;
        }

        return $categories;
    }

    public static function getFormats(): array
    {
        $formats = [];

        foreach (['pdf', 'excel'] as $key) {
            $label = $key === 'pdf' ? 'PDF Document' : str($key)->title() . ' Spreadsheet';
            $icon = "fa-file-{$key}";
            $color = $key === 'pdf' ? 'text-red-600' : 'text-green-600';
            $formats[$key] = compact('label', 'icon', 'color');
        }

        return $formats;
    }

    public static function getActions(): array
    {
        $configs = ['Reset to Default' => 'orange', 'Download Report' => 'green', 'Generate Report' => 'blue'];

        return collect($configs)->map(function ($color, $label) {
            $iconMap = ['Reset to Default' => 'undo', 'Download Report' => 'download', 'Generate Report' => 'wand-magic-sparkles'];
            $icon = "fa-{$iconMap[$label]}";
            $color = "bg-{$color}-600 hover:bg-{$color}-700";
            $type = ($label === 'Generate Report') ? 'submit' : 'button';

            return compact('label', 'icon', 'color', 'type');
        })->values()->all();
    }

    public static function getFields(): array
    {
        $fields = [
            'title' => ['type' => 'text', 'icon' => 'fa-heading'],
            'start_date' => ['type' => 'date', 'icon' => 'fa-calendar-alt'],
            'end_date' => ['type' => 'date', 'icon' => 'fa-calendar-check'],
            'data_category' => ['type' => 'select', 'icon' => 'fa-layer-group'],
        ];

        $formInputs = [];

        foreach ($fields as $model => $field) {
            $type = $field['type'];
            $icon = $field['icon'];
            $label = str($model)->headline()->lower();
            $placeholder = ($type === 'select' ? 'Select ' : 'Enter the report ') . $label . '.';
            $formInputs[$model] = compact('type', 'icon', 'placeholder');
        }

        return $formInputs;
    }

    public static function loadingTargets(): array
    {
        $save = 'Generating and saving report...';
        $selectReport = 'Loading report...';
        $createNewReport = 'Preparing fresh form...';
        $download = 'Downloading report...';
        $deleteReport = 'Deleting report...';

        return compact('save', 'selectReport', 'createNewReport', 'download', 'deleteReport');
    }
}
