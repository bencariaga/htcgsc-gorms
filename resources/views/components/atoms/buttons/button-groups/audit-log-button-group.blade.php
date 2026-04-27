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
