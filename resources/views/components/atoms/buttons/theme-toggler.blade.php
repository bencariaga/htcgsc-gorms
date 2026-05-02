<button @click="darkMode = !darkMode" class="text-lg w-[160px] flex justify-between items-center px-4 py-2 font-semibold hover:text-blue-700 dark:hover:text-blue-400 hover:bg-blue-100 dark:hover:bg-slate-700 rounded-xl transition-all group">
    <i class="fas mr-2.5 text-slate-400 group-hover:scale-110 group-hover:text-blue-500" :class="darkMode ? 'fa-sun' : 'fa-moon'"></i>
    <span x-text="darkMode ? 'Light Mode' : 'Dark Mode'"></span>
</button>
