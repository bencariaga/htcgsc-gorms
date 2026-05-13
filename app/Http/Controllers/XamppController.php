<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Artisan;

class XamppController extends Controller
{
    public function start()
    {
        return $this->runXamppCommand('xampp:start', 'XAMPP start commands have been dispatched.');
    }

    public function stop()
    {
        return $this->runXamppCommand('xampp:end', 'XAMPP stop commands have been executed.');
    }

    public function repair()
    {
        return $this->runXamppCommand('xampp:repair', 'XAMPP MySQL repair process completed successfully.', ['--no-interaction' => true]);
    }

    private function runXamppCommand(string $command, string $message, array $parameters = [])
    {
        Artisan::call($command, $parameters);

        return response()->json(['status' => 'success', 'message' => $message, 'output' => Artisan::output()]);
    }
}
