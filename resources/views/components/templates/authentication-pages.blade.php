<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ 'HTCGSC-GORMS | ' . ($title ?? '') }}</title>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/global.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('css/authentication-pages.css') }}">
        <link rel="preload" as="image" href="{{ asset('images/HTCGSC-campus.png') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/HTCGSC-GORMS-logo.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.0/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">

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

        @livewireStyles
    </head>

    <body class="min-h-screen flex items-center justify-center p-5" x-data="{ notifications: [] }" @notify.window="notifications.push({ id: Date.now(), type: $event.detail.type, message: $event.detail.message })">
        <div x-cloak class="mx-auto relative" style="width: {{ $maxWidth ?? '450px' }};">
            {{ $slot }}
        </div>

        <x-molecules.toast-notifications.tn-auth />

        @foreach (['success', 'error', 'warning', 'info'] as $type)
            @if(session($type))
                <script>
                    window.addEventListener('DOMContentLoaded', () => {
                        window.dispatchEvent(new CustomEvent('notify', {
                            detail: { type: '{{ $type }}', message: "{!! session($type) !!}" }
                        }));
                    });
                </script>
            @endif
        @endforeach

        @livewireScripts
    </body>
</html>
