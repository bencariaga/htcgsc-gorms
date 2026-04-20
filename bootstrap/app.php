<?php

use App\{Enums\NonDB\Exceptions as ExceptionEnum, Exceptions\FalsePositiveException};
use App\Http\Middleware\{CheckSystemConfiguration, RedirectIfAuthenticated, UpdateLastActivity};
use Illuminate\{Auth\Middleware\Authenticate, Http\Request, Session\TokenMismatchException, Support\Facades\Log};
use Illuminate\Foundation\{Application, Configuration\Exceptions, Configuration\Middleware};
use Symfony\Component\HttpKernel\Exception\HttpException;

return Application::configure(basePath: dirname(__DIR__))->withRouting(
    web: __DIR__ . '/../routes/web.php',
    api: __DIR__ . '/../routes/api.php',
    commands: __DIR__ . '/../routes/console.php',
    health: '/up',
)->withMiddleware(function (Middleware $middleware) {
    $middleware->append(CheckSystemConfiguration::class);
    $middleware->alias(['auth' => Authenticate::class, 'guest' => RedirectIfAuthenticated::class, 'check.config' => CheckSystemConfiguration::class]);
    $middleware->web(append: [UpdateLastActivity::class]);
    $middleware->preventRequestForgery(['api/google-forms']);
})->withExceptions(function (Exceptions $exceptions) {
    $exceptions->reportable(function (Throwable $e) {
        if (str($e->getFile())->contains('vendor')) {
            return false;
        }
    });

    $exceptions->render(function (HttpException $e, Request $request) {
        if ($e->getStatusCode() !== 419) {
            return null;
        }

        if ($request->expectsJson()) {
            return response()->json(['message' => 'Session expired, please refresh.'], 419);
        }

        return redirect()->back()->withInput($request->except('_token'))->with('info', 'Your session was refreshed. Please try again.');
    });

    $exceptions->render(function (TokenMismatchException $e, Request $request) {
        Log::warning('CSRF token mismatch detected.', ['url' => $request->fullUrl(), 'ip' => $request->ip(), 'user_id' => $request->user()?->user_id]);

        report($e);

        return redirect()->route('login')->with('info', 'Your session expired. Please sign in again.');
    });

    $exceptions->render(function (Throwable $e, Request $request) {
        $errorData = ExceptionEnum::getErrorData($e);

        if (!$errorData) {
            return null;
        }

        if ($request->is('api/*')) {
            return response()->json(['status' => 'error', 'message' => 'An internal error occurred while processing.'], 500);
        }

        return response()->view('errors.errors', collect([['error' => 500, 'code' => '500'], $errorData])->collapse()->all(), 500);
    });

    $exceptions->dontReport([FalsePositiveException::class]);
})->create();
