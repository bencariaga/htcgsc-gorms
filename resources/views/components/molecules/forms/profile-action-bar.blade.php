<div class="flex flex-col sm:flex-row items-center justify-evenly gap-4 pt-4 mt-2">
    @foreach ($buttons as $button)
        <button type="{{ $button['type'] }}" {!! $button['action'] !!} {!! $button['disabled'] !!} class="text-lg {{ $button['width'] }} flex justify-between items-center px-4 py-2 font-semibold {{ $button['colors'] }} rounded-xl transition-all group disabled:opacity-50 disabled:cursor-not-allowed">
            <i class="{{ $button['icon'] }} mr-2.5 group-hover:scale-110 transition-transform"></i>
            <span>{{ $button['text'] }}</span>
        </button>
    @endforeach
</div>
