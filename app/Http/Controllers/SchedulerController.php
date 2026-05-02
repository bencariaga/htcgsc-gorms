<?php

namespace App\Http\Controllers;

use Illuminate\{Http\Request, Support\Facades\Artisan};

class SchedulerController extends Controller
{
    public function __invoke(Request $request)
    {
        if ($request->query('key') !== config('services.cron_key')) {
            abort(403, 'Unauthorized cron access.');
        }

        Artisan::call('schedule:run');

        return response()->json(['status' => 'success', 'message' => 'Scheduler executed.', 'output' => Artisan::output()]);
    }
}
