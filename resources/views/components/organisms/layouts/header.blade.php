<x-molecules.loading-screens.ls id="loadingOptimize" message="Making the system run better..." />

<header class="h-20 bg-white dark:bg-slate-800 border-b border-slate-200 dark:border-slate-700 flex items-center justify-between pl-5 pr-10 z-10 shadow-sm transition-colors duration-300">
    <div class="flex items-center">
        <button @click="sidebarOpen = !sidebarOpen" class="text-slate-500 hover:text-emerald-700 focus:outline-none transition-colors p-2">
            <i class="fas fa-caret-left text-[30px]" :class="sidebarOpen ? '' : 'rotate-180'" x-init="setTimeout(() => $el.classList.add('transition-transform', 'duration-300'), 50)" x-cloak></i>
        </button>
    </div>

    <x-atoms.utility.digital-clock />

    <div class="flex items-center space-x-4">
        <x-atoms.buttons.button-groups.page-button-group variant="header" />

        <x-atoms.buttons.theme-toggler />

        <form id="optimizeForm" action="{{ route('cache.clear') }}" method="POST" class="inline" x-data @submit="$el.querySelector('button[type=submit]').disabled = true; document.getElementById('loadingOptimize').classList.replace('hidden', 'flex')">
            @csrf
            <button type="submit" class="text-lg w-[140px] flex justify-between items-center px-4 py-2 font-semibold hover:text-blue-700 dark:hover:text-blue-500 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all group">
                <i class="fas fa-broom mr-2.5 text-slate-400 group-hover:scale-110 group-hover:text-blue-500"></i>
                <span>Optimize</span>
            </button>
        </form>

        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit" class="text-lg w-[140px] flex justify-between items-center px-4 py-2 font-bold text-red-600 dark:text-red-500 hover:bg-red-100 dark:hover:bg-red-900/40 rounded-xl transition-all group">
                <i class="fas fa-sign-out mr-2.5 opacity-80 group-hover:scale-110 transition-transform"></i>
                <span>Sign Out</span>
            </button>
        </form>
    </div>
</header>
