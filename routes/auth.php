<?php

use App\Livewire\Authentication\{CreateAccount, ForgotPassword, Login, OneTimePasswordEAC, OneTimePasswordLogin, OneTimePasswordPNC};
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/', Login::class)->name('login');
    Route::get('/logout', fn () => redirect()->route('login'));
    Route::get('/create-account', CreateAccount::class)->name('account.create');
    Route::get('/forgot-password', ForgotPassword::class)->name('password.forgot');
    Route::get('/otp', OneTimePasswordLogin::class)->name('otp-login');
});

Route::middleware('auth')->group(function () {
    Route::match(['get', 'post'], '/logout', function () {
        Auth::guard('web')->logout();
        request()->session()->invalidate();
        request()->session()->regenerateToken();

        return redirect()->to('/');
    })->name('logout');

    Route::prefix('user-profile')->name('user-profile.')->group(function () {
        Route::get('otp-email-address', OneTimePasswordEAC::class)->name('otpEmail');
        Route::get('otp-phone-number', OneTimePasswordPNC::class)->name('otpPhone');
    });
});
