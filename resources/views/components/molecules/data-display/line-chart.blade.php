@props(['title', 'yAxisLabels', 'data', 'path', 'points'])

<div {{ $attributes->merge(['class' => 'flex flex-col h-full min-h-[300px]']) }}>
    <span class="text-lg font-semibold text-slate-700 dark:text-slate-300 mb-16">{{ $title }}</span>

    <div class="flex flex-1 gap-4">
        <div class="flex flex-col justify-between h-32 text-sm font-bold text-slate-700 dark:text-slate-300 w-6">
            @foreach($yAxisLabels as $label) <span>{{ $label }}</span> @endforeach
        </div>

        <div class="w-full relative flex-1 flex flex-col justify-between h-32 mb-10">
            <div class="absolute inset-0 flex flex-col justify-between h-32">
                @for($i = 0; $i < 3; $i++) <div class="border-b border-slate-300 dark:border-slate-700 w-full h-0"></div> @endfor
            </div>

            <div class="relative z-10 h-32">
                <svg viewBox="0 0 400 100" preserveAspectRatio="none" class="w-full h-full overflow-visible">
                    @foreach($data as $index => $date)
                        @if($date['is_first_of_month'])
                            <line x1="{{ $points[$index][0] }}" y1="-20" x2="{{ $points[$index][0] }}" y2="100" :stroke="darkMode ? '#ffffff' : '#000000'" stroke-width="2" stroke-dasharray="8" />
                            <text x="{{ $points[$index][0] }}" y="-30" text-anchor="middle" class="text-[12px] text-slate-700 dark:fill-slate-300 font-bold tracking-wide">{{ \Illuminate\Support\Carbon::parse("{$date['month_name']} {$date['year']}")->format('F Y') }}</text>
                        @endif
                    @endforeach

                    <path d="{{ $path }}" fill="none" stroke="#6366f1" stroke-width="3" stroke-linecap="round" />

                    @foreach($points as $index => $pt)
                        @if($index == 0 || $index == collect($data)->count() - 1 || $data[$index]['count'] != $data[max(0, $index-1)]['count'])
                            <circle cx="{{ $pt[0] }}" cy="{{ $pt[1] }}" r="3" fill="#4f46e5" />
                            <text x="{{ $pt[0] }}" y="{{ $pt[1] - 10 }}" text-anchor="middle" class="text-[10px] font-bold fill-slate-600 dark:fill-slate-400">{{ $data[$index]['count'] }}</text>
                        @endif
                    @endforeach
                </svg>
            </div>
        </div>
    </div>

    <div class="flex justify-between w-full px-1 pl-10">
        @foreach($data as $index => $date)
            <span class="text-xs leading-[1.3] text-center {{ $date['is_today'] ? 'text-indigo-600 dark:text-indigo-400 font-black' : 'text-slate-700 dark:text-slate-300 font-bold' }} {{ $index % 2 == 0 ? 'block' : 'hidden md:block' }}">
                {{ $date['label'] }}<br><span class="opacity-40">{{ $date['month_num'] }}</span>
            </span>
        @endforeach
    </div>
</div>
