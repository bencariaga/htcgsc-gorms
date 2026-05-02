<?php

namespace App\Traits\Miscellaneous;

use Illuminate\Http\{JsonResponse, RedirectResponse};

trait ProvidesMessages
{
    protected function messageResponse(string $message, string $type = 'success', int $status = 200): JsonResponse|RedirectResponse
    {
        if (request()->expectsJson()) {
            return response()->json(['type' => $type, 'message' => $message], $status);
        }

        return back()->with($type, $message);
    }

    protected function success(string $message, int $status = 200): JsonResponse|RedirectResponse
    {
        return $this->messageResponse($message, 'success', $status);
    }

    protected function error(string $message, int $status = 500): JsonResponse|RedirectResponse
    {
        return $this->messageResponse($message, 'error', $status);
    }

    protected function warning(string $message, int $status = 400): JsonResponse|RedirectResponse
    {
        return $this->messageResponse($message, 'warning', $status);
    }

    protected function info(string $message, int $status = 200): JsonResponse|RedirectResponse
    {
        return $this->messageResponse($message, 'info', $status);
    }

    protected function getUpdatedMessage(string $resource = 'User'): string
    {
        return "{$resource} profile has been <strong>updated</strong> successfully!";
    }

    protected function successResponse(string $message, int $status = 201): JsonResponse
    {
        return response()->json(['success' => true, 'message' => $message], $status);
    }

    protected function errorResponse(string $message, int $status = 500): JsonResponse
    {
        return response()->json(['success' => false, 'message' => $message], $status);
    }
}
