@props(['initialState', 'preloadedData', 'selectedFile', 'jsFields', 'jsFormats', 'actionHeader', 'fields', 'categories', 'today', 'formats', 'actions'])

<div class="flex-1 h-full p-4" x-data="reportForm({ initial: {{ $initialState }}, preloaded: {{ $preloadedData }}, isSelected: {{ $selectedFile ? 'true' : 'false' }}, fieldKeys: {{ $jsFields }}, formatLabels: {{ $jsFormats }} })" @report-loaded.window="handleReportLoaded($event.detail.data)" wire:ignore.self x-cloak>
    <div class="bg-white dark:bg-slate-800 shadow-sm border-2 border-slate-300 dark:border-slate-700 rounded-2xl overflow-hidden transition-colors duration-300">
        <div class="px-8 py-6">
            <h2 class="text-xl font-bold text-slate-800 dark:text-white">{{ $actionHeader }} Report</h2>
        </div>

        <form wire:submit.prevent="save(form)" class="px-8 pb-8 space-y-6">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 !m-0">
                @foreach ($fields as $key => $field)
                    <div class="space-y-1 col-span-1">
                        <label class="block text-base font-semibold text-slate-700 dark:text-slate-200 ml-1">
                            {{ str($key)->headline() }} <span class="text-red-500">*</span>
                        </label>

                        @if($key === 'data_category')
                            <div class="relative" x-data="{ categoryOpen: false }" @click.away="categoryOpen = false">
                                <button type="button" @click="categoryOpen = !categoryOpen" :class="isFieldDirty('data_category') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/20' : 'bg-gray-100 dark:bg-slate-900'" class="w-full h-[3rem] pl-12 pr-4 border-2 border-gray-300 dark:border-slate-700 focus:outline-none focus:border-emerald-500 rounded-xl flex items-center justify-between dark:text-white text-base">
                                    <span x-text="form.data_category || '{{ $field['placeholder'] }}'"></span>
                                    <i class="fas fa-caret-down text-xl transition-transform duration-300" :class="{ 'rotate-180': categoryOpen }"></i>
                                </button>

                                <div class="absolute left-4 top-1/2 -translate-y-1/2 w-6 flex justify-center">
                                    <i class="fas {{ $field['icon'] }} text-slate-600 dark:text-slate-400"></i>
                                </div>

                                <div x-show="categoryOpen" x-transition x-cloak class="absolute z-50 w-full bottom-full mb-2 bg-white dark:bg-slate-900 border border-gray-300 dark:border-slate-700 rounded-xl shadow-xl overflow-hidden p-1 gap-1 flex flex-col">
                                    @foreach($categories as $value => $label)
                                        @if($value !== '')
                                            <button type="button" @click="form.data_category = '{{ $label }}'; categoryOpen = false" class="w-full text-left px-4 py-2 text-base transition-colors rounded-lg hover:bg-slate-200 dark:hover:bg-slate-800" :class="form.data_category === '{{ $label }}' ? 'bg-emerald-100 dark:bg-emerald-900/50 text-emerald-600 dark:text-emerald-400 font-bold' : 'text-slate-700 dark:text-white'">
                                                {{ $label }}
                                            </button>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="relative flex items-center">
                                <div class="absolute left-4 w-6 flex justify-center">
                                    <i class="fas {{ $field['icon'] }} text-slate-600 dark:text-slate-400"></i>
                                </div>

                                <input type="{{ $field['type'] }}" x-model="form.{{ $key }}" @if($field['type'] === 'date') :min="'{{ $key }}' === 'end_date' ? form.start_date : ''" :max="'{{ $key }}' === 'start_date' ? (form.end_date || '{{ $today }}') : '{{ $today }}'" @endif placeholder="{{ $field['placeholder'] }}" :class="isFieldDirty('{{ $key }}') ? 'bg-orange-50 border-orange-300 dark:bg-orange-900/30' : 'bg-gray-100 dark:bg-slate-900/50'" class="w-full h-[3rem] pl-12 pr-6 py-2 border-2 border-gray-300 dark:border-slate-700 rounded-xl focus:outline-none focus:border-blue-500 focus:ring-2 focus:ring-blue-500/20 transition-all duration-200 dark:text-white dark:accent-blue-500 [color-scheme:light] dark:[color-scheme:dark] @if($field['type'] === 'date') [&::-webkit-calendar-picker-indicator]:cursor-pointer [&::-webkit-calendar-picker-indicator]:p-1 [&::-webkit-calendar-picker-indicator]:rounded-md hover:[&::-webkit-calendar-picker-indicator]:bg-blue-200 dark:hover:[&::-webkit-calendar-picker-indicator]:bg-blue-800 [&::-webkit-datetime-edit]:p-0 [&::-webkit-datetime-edit-fields-wrapper]:p-0 @endif">
                            </div>
                        @endif
                    </div>
                @endforeach

                <div class="md:col-span-2 space-y-1">
                    <label class="block text-base font-semibold text-slate-700 dark:text-slate-200 ml-1">
                        File Output Format <span class="text-red-500">*</span>
                    </label>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        @foreach ($formats as $value => $config)
                            <label :class="form.file_output_format === '{{ $config['label'] }}' ? 'border-emerald-500 bg-emerald-50 dark:bg-emerald-900/20' : 'border-gray-300 dark:border-slate-700 bg-gray-100 dark:bg-slate-900'" class="w-full h-[3rem] relative flex items-center px-4 border-2 rounded-xl cursor-pointer transition-all hover:border-emerald-400">
                                <input type="radio" name="format" value="{{ $config['label'] }}" @click="form.file_output_format = '{{ $config['label'] }}'" :checked="form.file_output_format === '{{ $config['label'] }}'" class="hidden">

                                <div class="flex items-center w-full">
                                    <div class="w-6 mr-3 flex justify-center items-center">
                                        <i class="fas {{ $config['icon'] }} {{ $config['color'] }} text-lg"></i>
                                    </div>

                                    <span class="font-semibold text-sm text-slate-700 dark:text-slate-200">
                                        {{ $config['label'] }}
                                    </span>
                                </div>

                                <i x-show="form.file_output_format === '{{ $config['label'] }}'" class="fas fa-check-circle absolute right-4 text-emerald-500 text-lg"></i>
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>

            <div class="pt-3 grid grid-cols-1 md:grid-cols-3 gap-6">
                @foreach ($actions as $action)
                    <button type="{{ $action['type'] }}" @if($action['clickAction']) @click="{{ $action['clickAction'] }}" @endif :disabled="canDisableAction('{{ $action['label'] }}')" class="{{ $action['color'] }} text-base w-full flex justify-center items-center gap-3 px-6 py-2.5 font-semibold text-white rounded-xl transition-all shadow-md group disabled:opacity-50 disabled:cursor-not-allowed">
                        <i class="fas {{ $action['icon'] }} transition-transform duration-300 {{ $action['label'] === 'Reset to Default' ? 'group-hover:-rotate-45' : 'group-hover:scale-110' }}"></i>
                        <span>{{ $action['displayText'] }}</span>
                    </button>
                @endforeach
            </div>
        </form>
    </div>
</div>
