<?php

use App\Http\Controllers\{GoogleFormController, SchedulerController};
use Illuminate\Support\Facades\Route;

Route::post('/google-forms', GoogleFormController::class);
Route::get('/system/run-scheduled-tasks', SchedulerController::class);
