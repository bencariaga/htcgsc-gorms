<tr {{ $attributes->merge(['class' => 'hover:bg-emerald-200/50 dark:hover:bg-emerald-800/50 even:bg-slate-300/30 dark:even:bg-slate-700/50 transition-colors']) }}>
    <x-dynamic-component :component="'organisms.tables.columns.audit-log'" :item="$item" :level="$level" cell-styling="px-6 py-4 h-[4.5rem]" />
</tr>
