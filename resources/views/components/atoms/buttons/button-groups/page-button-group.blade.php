@props(['variant' => 'sidebar'])

@use('App\Enums\NonDB\PageButtonStyling')

@php
    $styleEnum = PageButtonStyling::tryFrom($variant) ?? PageButtonStyling::SIDEBAR;
    $isHeader = $styleEnum === PageButtonStyling::HEADER;
@endphp

@foreach ($styleEnum->getMenuItems() as $item)
    @php
        $route = $item['route'];
        $isActive = request()->routeIs($route);
        $label = $item['label'];
    @endphp

    @if ($isHeader)
        <a href="{{ route($route) }}" class="text-lg {{ $item['width'] }} flex justify-between items-center px-4 py-2 font-semibold rounded-xl transition-all group {{ $isActive ? 'text-blue-700 dark:text-blue-400 bg-blue-100 dark:bg-slate-700' : 'hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700' }}">
            <i class="fas {{ $item['icon'] }} mr-2.5 {{ $isActive ? 'text-blue-500' : 'text-slate-400' }} group-hover:scale-110 group-hover:text-blue-500"></i>
            <span>{{ $label }}</span>
        </a>
    @else
        <li class="relative flex items-center group">
            <a href="{{ route($route) }}" class="flex items-center w-full px-3 py-2 rounded-lg {{ $isActive ? 'bg-white/10 text-yellow-300' : 'text-white' }} hover:bg-white/10 hover:text-emerald-300 transition-colors">
                <div class="w-8 h-8 flex justify-center items-center shrink-0 ml-0 mr-5">
                    <i class="fas {{ $item['icon'] }} text-lg {{ $isActive ? 'text-yellow-300' : 'text-white' }} group-hover:scale-110 group-hover:text-emerald-400 transition-transform"></i>
                </div>

                <span class="font-medium text-lg whitespace-nowrap" x-show="sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                    {{ $label }}
                </span>
            </a>

            <div x-show="!sidebarOpen" class="fixed left-20 ml-2 px-3 py-1 bg-emerald-700 text-white text-sm font-semibold rounded-md whitespace-nowrap opacity-0 group-hover:opacity-100 pointer-events-none transition-opacity duration-300">
                {{ $label }}
                <div class="absolute -left-1 top-1/2 -translate-y-1/2 border-8 border-transparent border-r-emerald-700"></div>
            </div>
        </li>
    @endif
@endforeach
