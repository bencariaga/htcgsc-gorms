<?php

namespace App\Traits\Has;

use App\Support\TimeZoneConverter;

trait HasAppInformation
{
    protected function getAppInfo(): array
    {
        $configs = ['Environment' => 'app.env', 'Debug Mode' => 'app.debug', 'Time Zone' => 'app.timezone', 'Log Channel' => 'logging.default'];

        return collect($configs)->map(function ($key, $label) {
            $value = ($label === 'Time Zone') ? TimeZoneConverter::format((string) config($key)) : config($key);

            return ['label' => $label, 'value' => (str((string) $value)->is('1') || str((string) $value)->is('0')) ? ($value ? 'True' : 'False') : $value, 'truncate' => $label === 'Time Zone'];
        })->values()->all();
    }
}
