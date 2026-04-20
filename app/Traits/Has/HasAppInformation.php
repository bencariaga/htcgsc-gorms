<?php

namespace App\Traits\Has;

use App\Support\TimeZoneConverter;
use Illuminate\Support\Str;

trait HasAppInformation
{
    protected function getAppInfo(): array
    {
        $configs = ['Environment' => 'app.env', 'Debug Mode' => 'app.debug', 'Time Zone' => 'app.timezone', 'Log Channel' => 'logging.default'];

        return collect($configs)->map(function ($key, $label) {
            $value = ($label === 'Time Zone') ? TimeZoneConverter::format((string) config($key)) : config($key);

            return ['label' => $label, 'value' => (Str::is('1', (string) $value) || Str::is('0', (string) $value)) ? ($value ? 'True' : 'False') : $value, 'truncate' => $label === 'Time Zone'];
        })->values()->all();
    }
}
