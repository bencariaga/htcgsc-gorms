<?php

namespace App\Actions\Auth;

use Illuminate\Support\Facades\Auth;

class LogoutUser
{
    public function handle(): void
    {
        Auth::guard('web')->logout();
        session()->invalidate();
        session()->regenerateToken();
    }
}
