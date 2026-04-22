<?php

use App\Http\Controllers\{StudentProfileController, UserProfileController};
use Illuminate\Support\{Facades\Artisan, Facades\Auth, Facades\Route};

Route::get('/setup', function () {
    try {
        Artisan::call('setup');

        return response()->json([
            'status' => 'Success',
            'log' => Artisan::output(),
        ]);
    } catch (Exception $e) {
        return response()->json([
            'status' => 'Failed',
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
        ], 500);
    }
});

Route::middleware('web')->group(function () {
    Route::get('/refresh-csrf', fn () => response()->json(['token' => csrf_token(), 'status' => config('app.key') ? 'ok' : 'error']));

    require __DIR__ . '/auth.php';

    Route::middleware(['auth'])->group(function () {
        require __DIR__ . '/livewire.php';

        Route::match(['get', 'post'], '/clear-cache', function () {
            Artisan::call('system:optimize');

            if (request()->isMethod('post')) {
                return redirect()->back()->with('success', 'System cache has been <strong>cleared</strong> successfully!');
            }

            Auth::guard('web')->logout();
            request()->session()->invalidate();
            request()->session()->regenerateToken();

            return redirect()->to('/')->with('success', 'System cache has been <strong>cleared and logged out</strong> successfully!');
        })->name('cache.clear');

        Route::prefix('user-profile')->name('user-profile.')->controller(UserProfileController::class)->group(function () {
            Route::get('{user?}', 'index')->name('index');
            Route::put('update/{user?}', 'update')->name('update');
            Route::post('update-password/{user?}', 'updatePassword')->name('updatePassword');
        });

        Route::post('student-profile/update', [StudentProfileController::class, 'update'])->name('student-profile.update');
    });
});
