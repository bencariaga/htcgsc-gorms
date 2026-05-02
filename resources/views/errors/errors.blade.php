<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        @if(request()->routeIs('audit-logs.index')) <meta http-equiv="refresh" content="0"> @endif
        @if(config('app.key')) <meta name="csrf-token" content="{{ csrf_token() }}"> @endif

        <title>HTCGSC-GORMS | {{ $title ?? 'Error' }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/global.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('css/authentication-pages.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/HTCGSC-GORMS-logo.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">

        <style>
            body {
                background-color: #0f172a;
                background-image: linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0)), url("{{ asset('images/HTCGSC-campus.png') }}");
                background-position: center;
                background-repeat: no-repeat;
                background-size: cover;
                background-attachment: fixed;
            }
        </style>
    </head>

    <body class="min-h-screen flex items-center justify-center p-5">
        <div class="mx-auto relative w-full max-w-lg">
            <div class="bg-white/90 backdrop-blur-md border border-slate-200 p-8 rounded-2xl shadow-xl text-center">
                <div class="text-amber-500 text-6xl mb-6">
                    <i class="fa fa-exclamation-triangle"></i>
                </div>

                <h1 class="text-slate-900 text-4xl font-bold mb-2">@yield('code', $code ?? '500')</h1>
                <h2 class="text-slate-700 text-xl font-medium mb-4">@yield('title', $title ?? 'Error')</h2>
                <p class="text-slate-600 mb-8">@yield('message', $message ?? 'An unexpected error occurred.')</p>

                <div class="flex flex-col gap-3">
                    <a href="{{ url()->previous() }}" class="w-full py-3 px-4 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold rounded-lg transition duration-200 text-center">
                        BACK TO THE PREVIOUS PAGE
                    </a>
                </div>
            </div>
        </div>
    </body>
</html>
