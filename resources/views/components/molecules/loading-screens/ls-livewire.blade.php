@props(['id' => null, 'message' => null])

<div @if($id) id="{{ $id }}" @endif wire:loading.flex class="fixed inset-0 z-[100] items-center justify-center bg-white/60 backdrop-blur-sm dark:bg-slate-900/60">
    <div class="flex flex-col items-center">
        <x-atoms.utility.spinner />

        @if($message)
            <div class="mt-4 text-lg bg-white/60 dark:bg-slate-800 px-5 py-3 rounded-xl font-semibold text-indigo-700 dark:text-indigo-500">
                {{ $message }}
            </div>
        @endif
    </div>
</div>
