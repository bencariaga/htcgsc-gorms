<div class="space-y-6">
    <div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            @foreach($texts as $text)
                <x-molecules.data-display.statistics-card :label="$text['label']" :total="$text['total']" :icon="$text['icon']" :icon-size="$text['iconSize']" :sub-icon="$text['subIcon']" :sub-icon-size="$text['subIconSize']" :subtext="$text['subtext']" :colors="$text['colors']" />
            @endforeach
        </div>

        <div class="bg-white dark:bg-slate-800 rounded-2xl shadow-lg border-2 border-gray-300 dark:border-slate-700 p-8">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-12">
                @foreach($charts as $chart)
                    <x-molecules.data-display.line-chart :title="$chart['title']" :y-axis-labels="$chart['yAxisLabels']" :data="$chart['data']" :path="$chart['path']" :points="$chart['points']"  />
                @endforeach
            </div>
        </div>
    </div>
</div>
