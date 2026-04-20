<div class="space-y-6">
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        @foreach($texts as $text)
            <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-md border-2 border-gray-300 dark:border-slate-700 p-6 transition-all hover:shadow-lg group">
                <div class="flex justify-between items-start">
                    <div>
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-300 uppercase tracking-widest">{{ $text['label'] }}</p>
                        <h3 class="text-3xl font-extrabold text-black dark:text-white mt-2">{{ $text['total'] }}</h3>
                    </div>

                    <div class="p-4 {{ $text['colors']['icon_bg'] }} rounded-xl border {{ $text['colors']['icon_border'] }} {{ $text['colors']['icon_text'] }} group-hover:scale-110 transition-transform">
                        <i class="{{ $text['icon'] }} {{ $text['iconSize'] }} text-center"></i>
                    </div>
                </div>

                <div class="mt-6 flex items-center text-sm font-bold {{ $text['colors']['badge_text'] }} {{ $text['colors']['badge_bg'] }} w-fit px-3 py-1.5 rounded-lg border {{ $text['colors']['badge_border'] }}">
                    <i class="{{ $text['subIcon'] }} mr-1.5 {{ $text['subIconSize'] }}"></i>
                    <span>{{ $text['subtext'] }}</span>
                </div>
            </div>
        @endforeach
    </div>

    <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-gray-300 dark:border-slate-700 p-8">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
            @foreach($charts as $chart)
                <div class="flex flex-col h-full min-h-[300px]">
                    <span class="text-lg font-semibold text-slate-700 dark:text-slate-300 mb-16">{{ $chart['title'] }}</span>

                    <div class="flex flex-1 gap-4">
                        <div class="flex flex-col justify-between h-32 text-sm font-bold text-slate-700 dark:text-slate-300 w-6">
                            @foreach($chart['yAxisLabels'] as $label) <span>{{ $label }}</span> @endforeach
                        </div>

                        <div class="w-full relative flex-1 flex flex-col justify-between h-32 mb-10">
                            <div class="absolute inset-0 flex flex-col justify-between h-32">
                                @for($i = 0; $i < 3; $i++) <div class="border-b border-slate-300 dark:border-slate-700 w-full h-0"></div> @endfor
                            </div>

                            <div class="relative z-10 h-32">
                                <svg viewBox="0 0 400 100" preserveAspectRatio="none" class="w-full h-full overflow-visible">
                                    @foreach($chart['data'] as $index => $date)
                                        @if($date['is_first_of_month'])
                                            <line x1="{{ $chart['points'][$index][0] }}" y1="-20" x2="{{ $chart['points'][$index][0] }}" y2="100" :stroke="darkMode ? '#ffffff' : '#000000'" stroke-width="2" stroke-dasharray="8" />
                                            <text x="{{ $chart['points'][$index][0] }}" y="-30" text-anchor="middle" class="text-[12px] text-slate-700 dark:fill-slate-300 font-bold tracking-wide">{{ \Illuminate\Support\Carbon::parse("{$date['month_name']} {$date['year']}")->format('F Y') }}</text>
                                        @endif
                                    @endforeach

                                    <path d="{{ $chart['path'] }}" fill="none" stroke="#6366f1" stroke-width="3" stroke-linecap="round" />

                                    @foreach($chart['points'] as $index => $pt)
                                        @if($index == 0 || $index == collect($chart['data'])->count() - 1 || $chart['data'][$index]['count'] != $chart['data'][max(0, $index-1)]['count'])
                                            <circle cx="{{ $pt[0] }}" cy="{{ $pt[1] }}" r="3" fill="#4f46e5" />
                                            <text x="{{ $pt[0] }}" y="{{ $pt[1] - 10 }}" text-anchor="middle" class="text-[10px] font-bold fill-slate-600 dark:fill-slate-400">{{ $chart['data'][$index]['count'] }}</text>
                                        @endif
                                    @endforeach
                                </svg>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-between w-full px-1 pl-10">
                        @foreach($chart['data'] as $index => $date)
                            <span class="text-xs leading-[1.3] text-center {{ $date['is_today'] ? 'text-indigo-600 dark:text-indigo-400 font-black' : 'text-slate-700 dark:text-slate-300 font-bold' }} {{ $index % 2 == 0 ? 'block' : 'hidden md:block' }}">
                                {{ $date['label'] }}<br><span class="opacity-40">{{ $date['month_num'] }}</span>
                            </span>
                        @endforeach
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
