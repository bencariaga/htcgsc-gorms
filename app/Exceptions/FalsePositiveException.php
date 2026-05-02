<?php

namespace App\Exceptions;

use Exception;
use Illuminate\{Http\Request, Support\Facades\Auth};
use Symfony\Component\HttpFoundation\Response;

class FalsePositiveException extends Exception
{
    public function report(): bool
    {
        return false;
    }

    public function render(Request $request): Response
    {
        if (Auth::guest()) {
            return $this->handleGuestResponse($request);
        }

        $message = $this->getMessage() ?: 'A minor problem happened, but we handled it for you.';

        if ($request->expectsJson()) {
            $status = 'bounced';

            return response()->json(compact('message', 'status'), 200);
        }

        return back()->with('warning', $message);
    }

    private function handleGuestResponse(Request $request): Response
    {
        if ($request->is('audit-logs*') && url()->previous() !== url()->current()) {
            return redirect()->back();
        }

        return redirect()->route('login');
    }
}
