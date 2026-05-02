<main wire:key="submissions-{{ $selectedFileName }}" x-data="{ filter: 'All', submissions: {{ $renderedSubmissions }}, get filteredSubmissions() { return this.filter === 'All' ? this.submissions : (this.filter === 'Yourself' ? this.submissions.filter(s => s.referral_type === 'Yourself') : this.submissions.filter(s => s.referral_type !== 'Yourself')); } }" x-show="!$store.formPreview.activeSubmission" x-effect="submissions = {{ $renderedSubmissions }}" class="flex-1 flex flex-col min-w-0 overflow-y-auto [scrollbar-width:thin] [scrollbar-color:rgba(16,185,129,0.5)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-emerald-500/50 bg-gray-50 dark:bg-gray-900 transition-colors duration-300">
    <div class="sticky top-0 z-10 bg-white/80 dark:bg-gray-900/80 backdrop-blur-md border-b border-gray-400/80 dark:border-gray-600/80 px-8 py-6">
        <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-4">
            <div class="flex items-center gap-3">
                <i class="fas fa-file-alt text-emerald-600 dark:text-emerald-400 text-xl"></i>
                <span class="text-2xl font-bold text-gray-800 dark:text-emerald-50">File: {{ $selectedFileName }}</span>
            </div>

            <div class="bg-emerald-100 dark:bg-emerald-900/30 px-4 py-2 rounded-lg border border-emerald-300 dark:border-emerald-700">
                <span class="text-xl font-semibold text-emerald-700 dark:text-emerald-300">Total Submissions:</span>
                <span class="ml-2 text-xl font-bold text-emerald-600 dark:text-emerald-400">{{ collect($submissions)->count() }}</span>
            </div>
        </div>
    </div>

    <div class="px-8 py-6">
        <template x-if="submissions.length === 0">
            <div class="flex flex-col items-center justify-center pt-[35px] pb-[3rem] text-center bg-gray-100 dark:bg-gray-800 rounded-2xl border border-gray-400 dark:border-gray-600 shadow-sm">
                <div class="bg-slate-300 dark:bg-slate-900/50 flex justify-center items-center rounded-full h-20 w-20 text-slate-400 dark:text-slate-500 text-3xl mb-6">
                    <i class="fas fa-inbox"></i>
                </div>
                <span class="text-lg font-bold text-slate-800 dark:text-white">No submission data found</span>
                <span class="text-slate-600 dark:text-slate-400 text-base font-medium mt-2">
                    This log file does not contain any Google Form submissions.
                </span>
                <span class="text-slate-600 dark:text-slate-400 text-base font-medium mt-2">
                    Try <button onclick="window.location.reload();" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">refresh the page</button>.
                </span>
            </div>
        </template>

        <template x-if="submissions.length > 0">
            <div>
                <div class="flex flex-wrap items-center justify-between gap-4 mb-8">
                    <div class="flex flex-wrap gap-0 border border-gray-400 dark:border-gray-600 bg-gray-200/70 dark:bg-gray-700/40 rounded-xl">
                        @foreach($sbms['filters'] as $filter)
                            <button @click="filter = '{{ $filter['value'] }}'" :class="filter === '{{ $filter['value'] }}' ? 'bg-emerald-700/90 text-white shadow-sm' : 'text-gray-600 dark:text-gray-400 hover:bg-gray-300/50 dark:hover:bg-gray-700'" class="px-5 py-2 text-sm font-semibold transition-all duration-200 flex items-center border-l border-gray-400 dark:border-gray-600 first:border-l-0 first:rounded-l-lg last:rounded-r-lg">
                                <span>{{ str($filter['label'])->replace('Yourself', 'Themselves') }}</span>
                                <span class="ml-2 px-[8px] py-[3px] bg-emerald-500 text-white dark:text-black font-semibold text-sm tabular-nums rounded-full">{{ $filter['count'] }}</span>
                            </button>
                        @endforeach
                    </div>

                    <div class="tracking-[0.25px] tabular-nums text-base font-semibold text-emerald-700 dark:text-emerald-400">
                        <i class="fas fa-eye mr-1.5"></i>
                        Showing <span x-text="filteredSubmissions.length"></span> of <span x-text="submissions.length"></span>
                    </div>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <template x-for="(data, index) in filteredSubmissions" :key="index">
                        <button type="button" @click="$store.formPreview.load(data)" :class="$store.formPreview.activeSubmission === data ? 'ring-4 ring-emerald-500 border-transparent' : 'border-gray-400 dark:border-gray-600'" class="group relative bg-gray-100 dark:bg-gray-700/50 rounded-2xl shadow-sm hover:shadow-xl hover:scale-[1.05] transition-all duration-300 border overflow-hidden p-6 text-left">
                            <h2 class="text-lg font-bold text-gray-800 dark:text-gray-100 group-hover:text-emerald-600 dark:group-hover:text-emerald-400 transition-colors mb-4" x-text="`${data['Last Name (Referral)'] || ''}, ${data['First Name (Referral)'] || ''} ${data['Middle Name (Referral)'] ? data['Middle Name (Referral)'].trim().substring(0,1) + '.' : ''}`"></h2>

                            <div class="h-[4.5rem]">
                                <span class="text-gray-700/80 dark:text-gray-300/80 font-medium text-balance text-base line-clamp-3 leading-relaxed" x-text="`&quot;${(data.reason || 'No reason provided').trim().replace(/\.*$/, '')}.&quot;`"></span>
                            </div>

                            <div class="mt-6 space-y-3">
                                <div class="flex items-center justify-between py-2 border-t border-gray-500">
                                    @foreach($sbms['appointmentDetails'] as $appointmentDetail)
                                        <div class="flex items-center gap-1.5 font-semibold text-[12px] text-gray-700 dark:text-gray-300">
                                            <i class="far {{ $appointmentDetail['icon'] }} text-emerald-500"></i>
                                            <span x-text="data.appointment_{{ $appointmentDetail['value'] }} || '---'"></span>
                                        </div>
                                    @endforeach
                                </div>

                                @foreach($sbms['referralStates'] as $referralState)
                                    <template x-if="{{ $referralState['condition'] }}">
                                        <span class="text-black dark:text-white">{!! $referralState['content'] !!}</span>
                                    </template>
                                @endforeach
                            </div>
                        </button>
                    </template>
                </div>

                <template x-if="filteredSubmissions.length === 0">
                    <div class="flex flex-col items-center justify-center pt-[35px] pb-[3rem] text-center bg-gray-100 dark:bg-gray-800 rounded-2xl border border-gray-400 dark:border-gray-600 shadow-sm">
                        <div class="bg-slate-300 dark:bg-slate-900/50 flex justify-center items-center rounded-full h-20 w-20 text-slate-400 dark:text-slate-500 text-3xl mb-6">
                            <i class="fas fa-search"></i>
                        </div>
                        <span class="text-lg font-bold text-slate-800 dark:text-white">No matching submissions found</span>
                        <span class="text-slate-600 dark:text-slate-400 text-base font-medium mt-2">
                            Try <button @click="filter = 'All'" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">clear the filter</button>
                            OR <button onclick="window.location.reload();" class="text-indigo-600 dark:text-indigo-400 hover:underline font-bold">refresh the page</button>.
                        </span>
                    </div>
                </template>
            </div>
        </template>
    </div>
</main>
