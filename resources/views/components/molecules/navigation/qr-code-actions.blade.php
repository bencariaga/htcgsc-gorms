@props(['actions', 'copied' => false])

<div {{ $attributes->merge(['class' => 'grid grid-cols-1 md:grid-cols-2 gap-4 mt-4 mb-1 pl-6 pr-4 pb-6']) }}>
    @foreach($actions as $action)
        @if($action['type'] === 'button')
            <button type="button" @click="{{ $action['click'] === 'download' ? '$wire.download()' : 'copyToClipboard()' }}" class="{{ $action['containerClass'] }} flex justify-start items-center py-2 font-semibold rounded-xl transition-all group {{ $action['class'] }}">
                <div class="{{ $action['iconWrapper'] }} flex justify-center">
                    <i :class="copied && '{{ $action['text'] }}' === 'Copy Google Form Link' ? '{{ $action['activeIcon'] }}' : '{{ $action['icon'] }}'" class="{{ $action['iconClass'] }} group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="{{ $action['spanClass'] }}">
                    <span x-text="copied && '{{ $action['text'] }}' === 'Copy Google Form Link' ? '{{ $action['activeText'] }}' : '{{ $action['text'] }}'"></span>
                </span>
            </button>
        @else
            <a href="{{ $action['href'] }}" target="_blank" rel="noopener noreferrer" class="{{ $action['containerClass'] }} flex justify-start items-center py-2 font-semibold rounded-xl transition-all group {{ $action['class'] }}">
                <div class="{{ $action['iconWrapper'] }} flex justify-center">
                    <i class="{{ $action['icon'] }} {{ $action['iconClass'] }} group-hover:scale-110 transition-transform"></i>
                </div>
                <span class="{{ $action['spanClass'] }}">{{ $action['text'] }}</span>
            </a>
        @endif
    @endforeach
</div>
