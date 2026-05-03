<div {{ $attributes->merge(['class' => 'fixed inset-0 z-[120] items-center justify-center bg-white/60 backdrop-blur-sm ' . ($darkMode ? 'dark:bg-slate-900/60' : '')]) }}>
    <div class="flex flex-col items-center">
        <x-atoms.utility.spinner :dark-mode="$darkMode" />

        @if($bladeViewName === 'components.molecules.loading-screens.ls-list-type')
            <p id="loading-message" class="mt-4 text-lg font-semibold text-indigo-700 {{ $darkMode ? 'dark:text-indigo-500' : '' }}"></p>
            <p id="loading-person" class="mt-4 text-2xl font-bold text-slate-800 {{ $darkMode ? 'dark:text-white' : '' }} text-center px-4"></p>
        @else
            @if($message)
                <div class="mt-4 text-lg bg-white/60 {{ $darkMode ? 'dark:bg-slate-800' : '' }} px-5 py-3 rounded-xl font-semibold text-indigo-700 {{ $darkMode ? 'dark:text-indigo-500' : '' }}">
                    {!! $message !!}
                </div>
            @endif
        @endif
    </div>
</div>
