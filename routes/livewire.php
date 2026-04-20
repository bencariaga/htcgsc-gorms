<?php

use Illuminate\Support\Facades\Route;

$pageNames = ['Dashboard', 'Submissions', 'Users', 'Students', 'Appointments', 'QrCode', 'Reports', 'AuditLogs'];

foreach ($pageNames as $name) {
    $appLivewirePages = "App\Livewire\Pages\\";

    $class = "$appLivewirePages$name";

    $uri = str($name)->kebab();

    Route::get($uri, $class)->name("{$uri}.index");
}
