<td class="px-6 py-4 h-[4.5rem] w-[110px]">
    <x-atoms.utility.status-badge :level="$item['level']" />
</td>

<td class="px-6 py-4 h-[4.5rem] w-[16rem]">
    <span class="text-sm font-bold text-slate-700 dark:text-slate-200 flex justify-between items-center gap-1 text-center tracking-[0.5px] tabular-nums">
        <div class="whitespace-nowrap">
            {{ $item['datetime'] }}
        </div>
    </span>
</td>

<td class="group relative px-6 py-4 font-[500] text-slate-700 dark:text-slate-200 break-all h-[4.5rem] w-[33rem]">
    <x-atoms.buttons.action-buttons.audit-log-group :item="$item" />
</td>
