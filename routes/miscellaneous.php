<?php

use Illuminate\Support\Facades\{Artisan, File, Route};

$handleRouteAction = fn (callable $action) => $action(...) ?: null;

Route::get('/setup', fn () => $handleRouteAction(fn () => response()->json(['status' => 'Success', 'log' => Artisan::call('setup') ?? Artisan::output()])));
Route::get('/delete-logs', fn () => $handleRouteAction(fn () => File::exists($gfLogPath = storage_path('logs/google-forms')) ? (File::put($gfLogPath, '') ? response()->json(['status' => 'Success', 'message' => 'Log file cleared successfully.']) : null) : response()->json(['status' => 'Success', 'message' => 'Log file does not exist, nothing to clear.'])));
