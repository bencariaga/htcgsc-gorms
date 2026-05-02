<div id="loading-screen" class="hidden fixed inset-0 z-[100] items-center justify-center bg-white/60 backdrop-blur-sm dark:bg-slate-900/60">
    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 flex flex-col items-center">
        <x-atoms.utility.spinner />

        <p id="loading-message" class="mt-4 text-lg font-semibold text-indigo-700 dark:text-indigo-500"></p>
        <p id="loading-person" class="mt-4 text-2xl font-bold text-slate-800 dark:text-white text-center px-4"></p>
    </div>
</div>
