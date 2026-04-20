@props(['action', 'click' => null, 'activeCondition' => null, 'activeText' => null])

@php
    $config = \App\Enums\NonDB\AuditLogsStyling::ACTIONS[$action];
    $color = $config['color'] ?? 'slate';
    $width = $config['width'] ?? '10rem';
    $baseClasses = "w-[{$width}] font-bold text-{$color}-600 dark:text-{$color}-400 flex justify-evenly transition-colors";
    $hoverClass = "hover:text-{$color}-800 dark:hover:text-{$color}-200";
@endphp

<button type="button" @if($click) @click="{{ $click }}" @endif {{ $attributes->merge(['class' => "$baseClasses $hoverClass"]) }}>
    <div class="flex flex-row items-center justify-evenly">
        @if($activeCondition)
            <i :class="{{ $activeCondition }} ? 'fas fa-check text-green-500' : '{{ $config['icon'] }}'" class="text-lg mr-2 transition-transform"></i>
            <span x-text="{{ $activeCondition }} ? '{{ $activeText }}' : '{{ $config['title'] }}'"></span>
        @else
            <i class="{{ $config['icon'] }} text-lg mr-2"></i>
            {{ $config['title'] }}
        @endif
    </div>
</button>
