@php
    $time = now()->format('M. d, Y | h:i:s A');
@endphp

<div x-data="{
        time: '{{ $time }}',
        updateClock() {
            const now = new Date();
            const dateOptions = { month: 'short', day: '2-digit', year: 'numeric' };
            const timeOptions = { hour: '2-digit', minute: '2-digit', second: '2-digit', hour12: true };

            const datePart = now.toLocaleDateString('en-US', dateOptions);
            const timePart = now.toLocaleTimeString('en-US', timeOptions);
            const [month, day, year] = datePart.replace(',', '').split(' ');

            this.time = `${month}. ${day}, ${year} | ${timePart}`;
        }
    }" x-init="setInterval(() => updateClock(), 1000)" {{ $attributes->merge(['class' => 'flex items-center justify-center flex-1']) }}>
    <span x-cloak x-text="time" class="text-slate-600 dark:text-slate-300 font-bold tracking-wider text-center tabular-nums min-w-[260px] font-['Inter']">
        {{ $time }}
    </span>

    {{-- <span class="text-slate-600 dark:text-slate-300 font-bold tracking-wider text-center tabular-nums min-w-[260px] font-['Inter']">
        Mar. 01, 2026 | 12:00:00 AM
    </span> --}}
</div>
