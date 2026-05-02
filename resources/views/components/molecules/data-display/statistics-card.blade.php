@props(['label', 'total', 'icon', 'iconSize' => 'text-3xl', 'subIcon', 'subIconSize' => 'text-sm', 'subtext', 'colors'])

<div {{ $attributes->merge(['class' => 'bg-white dark:bg-slate-800 rounded-2xl shadow-md border-2 border-gray-300 dark:border-slate-700 p-6 transition-all hover:shadow-lg group']) }}>
    <div class="flex justify-between items-start">
        <div>
            <p class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-widest">{{ $label }}</p>
            <h3 class="text-3xl font-extrabold text-black dark:text-white mt-2">{{ $total }}</h3>
        </div>

        <div class="p-4 {{ $colors['icon_bg'] }} rounded-xl border {{ $colors['icon_border'] }} {{ $colors['icon_text'] }} group-hover:scale-110 transition-transform">
            <i class="{{ $icon }} {{ $iconSize }} text-center"></i>
        </div>
    </div>

    <div class="mt-6 flex items-center text-sm font-bold {{ $colors['badge_text'] }} {{ $colors['badge_bg'] }} w-fit px-3 py-1.5 rounded-lg border {{ $colors['badge_border'] }}">
        <i class="{{ $subIcon }} mr-1.5 {{ $subIconSize }}"></i>
        <span>{{ $subtext }}</span>
    </div>
</div>
