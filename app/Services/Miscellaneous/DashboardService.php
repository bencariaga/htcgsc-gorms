<?php

namespace App\Services\Miscellaneous;

use Illuminate\Support\{Facades\Auth, Str};

class DashboardService
{
    public function getDashboardData(): array
    {
        $now = now();
        $user = Auth::user()?->load('person');
        $types = ['charts', 'texts'];

        foreach ($types as $type) {
            $formatted = Str::singular(Str::ucfirst($type));
            $className = "\\App\\Actions\\Dashboard\\Render{$formatted}Statistics";
            $$type = (new $className)->handle($now);
        }

        extract($texts);

        return compact('user', 'now', 'texts', 'charts', 'texts', 'nextAppointment', 'nextAppointmentTime');
    }
}
