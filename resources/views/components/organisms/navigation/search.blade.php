<div class="flex items-center gap-3 h-[2.5rem]">
    <div class="relative flex items-center">
        <i class="fas fa-search absolute left-4 text-slate-400"></i>
        <input wire:model.live.debounce.300ms="search" type="text" placeholder="Search..." class="pl-12 pr-4 py-2 h-[2.5rem] {{ $width }} bg-gray-100 focus:bg-white dark:bg-slate-900 dark:text-white border-2 border-gray-400 dark:border-slate-600 rounded-lg text-sm transition-all !placeholder-black/50 dark:!placeholder-white/50 placeholder:font-semibold">
    </div>
</div>
