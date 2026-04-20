@props(['id' => null, 'message' => null])

<div id="{{ $id }}" class="hidden fixed inset-0 z-[100] items-center justify-center bg-white/60 backdrop-blur-sm dark:bg-slate-900/60">
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
        <x-atoms.utility.spinner />

        @if($message)
            <div class="mt-4 text-lg {{ Route::is(['qr-code.index', 'dashboard.index']) ? 'bg-white/60 dark:bg-slate-800 px-5 py-3 rounded-xl' : '' }} font-semibold text-indigo-700 dark:text-indigo-500">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
