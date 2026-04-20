@props(['title' => 'Dashboard', 'padding' => '20px', 'important' => '', 'type' => null ])

<!DOCTYPE html>
<html lang="en" x-data="{ sidebarOpen: $persist(true), darkMode: $persist(false), notifications: [] }" :class="{ 'dark': darkMode }">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ 'HTCGSC-GORMS | ' . ($title ?? '') }}</title>

        <script>
            (function() {
                const sd = localStorage.getItem('_x_sidebarOpen');
                const dm = localStorage.getItem('_x_darkMode');

                if (dm === 'true') {
                    document.documentElement.classList.add('dark');
                } else {
                    document.documentElement.classList.remove('dark');
                }

                const style = document.createElement('style');

                style.id = 'anti-flash-style';

                style.innerHTML = `
                    [x-cloak] { display: none !important; }
                    .sidebar-lock {
                        width: ${sd === 'false' ? '5rem' : '18rem'} !important;
                        transition: none !important;
                    }
                `;

                document.head.appendChild(style);
            })();
        </script>

        <script src="https://cdn.tailwindcss.com"></script>
        <script src="{{ asset('js/global.js') }}"></script>

        <link rel="stylesheet" href="{{ asset('css/personal-pages.css') }}">
        <link rel="icon" type="image/png" href="{{ asset('images/HTCGSC-GORMS-logo.png') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
        <link href="https://fonts.googleapis.com/css2?family=Inter:wght@100..900&display=swap" rel="stylesheet">

        <script>
            tailwind.config = {
                darkMode: 'class',
                theme: {
                    extend: {
                        colors: {
                            app: {
                                bg: 'rgb(var(--color-background) / <alpha-value>)',
                                surface: 'rgb(var(--color-surface) / <alpha-value>)',
                                body: 'rgb(var(--color-text) / <alpha-value>)',
                            }
                        }
                    }
                }
            }
        </script>

        @livewireStyles
    </head>

    <body class="bg-slate-50 dark:bg-slate-900 text-slate-800 dark:text-slate-100 overflow-hidden duration-300" @notify.window="notifications.push({ id: Date.now(), type: $event.detail.type, message: $event.detail.message })">
        <div class="flex h-screen overflow-hidden">
            <x-organisms.layouts.sidebar />

            <div class="flex-1 flex flex-col overflow-hidden">
                <x-organisms.layouts.header />

                <main style="padding: {{ $padding }} {{ $important }};" class="flex-1 overflow-y-auto bg-slate-100 dark:bg-slate-900 duration-300 [scrollbar-color:theme(colors.gray.400)_transparent] dark:[scrollbar-color:theme(colors.slate.600)_transparent] [scrollbar-width:thin]">
                    {{ $slot }}
                </main>

                <x-organisms.layouts.footer :type="$type ?? null" />
            </div>
        </div>

        @livewireScripts
    </body>
</html>
