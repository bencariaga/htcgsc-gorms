@use('Illuminate\Support\Arr')
@use('Illuminate\Support\Facades\Validator')

<div class="flex items-center justify-center h-[2.5rem] max-w-[25.5rem]">
    @if($paginator->hasPages())
        <nav role="navigation" aria-label="Pagination Navigation" class="flex items-center gap-2">
            <button type="button" wire:click="previousPage" wire:loading.attr="disabled" @disabled($paginator->onFirstPage()) class="flex items-center justify-center h-[2.5rem] w-[2.5rem] text-emerald-600 bg-white dark:bg-slate-900 border-2 border-gray-400 dark:border-slate-600 rounded-lg hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-chevron-left text-base [-webkit-text-stroke:1.5px_currentColor]"></i>
            </button>

            <div class="flex items-center gap-2">
                @foreach ($paginator->render()->getData()['elements'] as $element)
                    @if(Validator::make(['element' => $element], ['element' => 'string'])->passes())
                        <span aria-disabled="true"><span class="flex items-center justify-center h-[2.5rem] w-[2rem] text-gray-700 dark:text-white font-semibold text-xl">{{ $element }}</span></span>
                        @continue
                    @endif

                    @if(!Arr::accessible($element)) @continue @endif

                    @foreach ($element as $page => $url)
                        @if($page == $paginator->currentPage())
                            <span class="flex items-center justify-center h-[2.5rem] min-w-[2.5rem] px-3 bg-emerald-600 text-white rounded-lg font-bold shadow-md border-2 border-emerald-600">{{ $page }}</span>
                            @continue
                        @endif

                        <button type="button" wire:click="gotoPage({{ $page }})" wire:loading.attr="disabled" class="flex items-center justify-center h-[2.5rem] min-w-[2.5rem] px-3 text-slate-700 dark:text-slate-300 bg-white dark:bg-slate-900 border-2 border-gray-400 dark:border-slate-600 rounded-lg hover:border-emerald-500 hover:text-emerald-500 transition-all font-semibold">{{ $page }}</button>
                    @endforeach
                @endforeach
            </div>

            <button type="button" wire:click="nextPage" wire:loading.attr="disabled" @disabled(!$paginator->hasMorePages()) class="flex items-center justify-center h-[2.5rem] w-[2.5rem] text-emerald-600 bg-white dark:bg-slate-900 border-2 border-gray-400 dark:border-slate-600 rounded-lg hover:border-emerald-500 hover:bg-emerald-50 dark:hover:bg-emerald-900/20 transition-all shadow-sm disabled:opacity-50 disabled:cursor-not-allowed">
                <i class="fas fa-chevron-right text-base [-webkit-text-stroke:1.5px_currentColor]"></i>
            </button>
        </nav>
    @endif
</div>
