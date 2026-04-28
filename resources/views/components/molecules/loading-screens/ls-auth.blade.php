<div wire:loading wire:target="{{ $target }}" class="fixed inset-0 z-[100] items-center justify-center bg-white/60 backdrop-blur-sm">
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
        <x-atoms.utility.spinner :dark-mode="false" />

        <p class="mt-4 text-lg font-semibold text-indigo-600">
            {{ $message }}
        </p>
    </div>
</div>
