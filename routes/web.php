<?php

use App\Http\Controllers\{StudentProfileController, UserProfileController};
use App\Livewire\{Authentication\OneTimePasswordEAC, Authentication\OneTimePasswordPNC, Pages\UserProfile};
use Illuminate\Support\{Facades\Artisan, Facades\Auth, Facades\Route};

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

        Route::get('user-profile/{user?}', UserProfile::class)->name('user-profile.index');
        Route::post('students/update', [StudentProfileController::class, 'update'])->name('student-profile.update');
        Route::put('user-profile/{user}/update', [UserProfileController::class, 'update'])->name('user-profile.update');
        Route::post('user-profile/{user}/update-password', [UserProfileController::class, 'updatePassword'])->name('user-profile.updatePassword');
        Route::get('user-profile/otp-email', OneTimePasswordEAC::class)->name('user-profile.otpEmail');
        Route::get('user-profile/otp-phone', OneTimePasswordPNC::class)->name('user-profile.otpPhone');
    });
});
