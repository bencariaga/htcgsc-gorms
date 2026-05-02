<?php

namespace App\Services\Miscellaneous;

use Illuminate\Support\Facades\Auth;

class DashboardService
{
    public function getDashboardData(): array
    {
        $now = now();
        $user = Auth::user()?->load('person');
        $types = ['charts', 'texts'];

        foreach ($types as $type) {
            $formatted = str($type)->ucfirst()->singular();
            $className = "\\App\\Actions\\Dashboard\\Render{$formatted}Statistics";
            $$type = (new $className)->handle($now);
        }

        extract($texts);

        return compact('user', 'now', 'texts', 'charts', 'nextAppointment', 'nextAppointmentTime');
    }
}
