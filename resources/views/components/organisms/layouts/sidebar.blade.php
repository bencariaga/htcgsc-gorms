<aside class="bg-[#006134] text-white transition-all duration-300 ease-in-out flex flex-col shadow-xl z-20 sidebar-lock" :class="sidebarOpen ? 'w-72' : 'w-20'" x-init="$el.classList.remove('sidebar-lock')">
    <div class="h-20 px-[13px] flex items-center border-b border-white/10 overflow-hidden">
        <div class="flex items-center">
            <div class="h-[54px] w-[54px] flex items-center justify-center shrink-0">
                <x-atoms.images.system-logo class="h-full object-contain" />
            </div>

            <div class="ml-[9px] flex flex-col leading-tight overflow-hidden whitespace-nowrap" x-show="sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
                <span class="font-bold text-base tracking-tight uppercase text-emerald-400">HTCGSC-GORMS</span>
                <span class="font-medium text-[14px] leading-[1.2] text-white/80">Guidance Office Records<br>Management System</span>
            </div>
        </div>
    </div>

    <nav class="flex-1 overflow-y-auto py-6 no-scrollbar">
        <ul class="px-3 flex flex-col gap-[10px]">
            <x-atoms.buttons.button-groups.page-button-group variant="sidebar" />
        </ul>
    </nav>

    <div class="h-20 px-4 bg-black/20 flex items-center overflow-hidden">

        <x-atoms.images.user-avatar :user="$user" :person="$person" class="h-12 w-12" />

        <div class="ml-4 overflow-hidden" x-show="sidebarOpen" x-cloak x-transition:enter="transition ease-out duration-300" x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100">
            <p class="text-[14px] font-semibold truncate">{{ $formalName }}</p>
            <p class="text-[12px] mt-1 uppercase tracking-wider text-emerald-300 font-bold leading-none">{{ $userType }}</p>
        </div>
    </div>
</aside>
