@use('App\Enums\NonDB\AuditLogsStyling')

<aside class="w-72 bg-white dark:bg-slate-800 border-r-2 border-gray-300 dark:border-slate-700 flex flex-col h-full">
    @if(!request()->routeIs('audit-logs.index'))
        <div class="flex justify-center font-bold text-black dark:text-white py-[15.75px] border-b-2 border-gray-300 dark:border-slate-700">
            <span class="text-xl">{{ $title }}</span>
        </div>
    @endif

    @if(collect($items)->count() > 0)
        <div class="p-2 border-b-2 border-gray-300 dark:border-slate-700 bg-slate-100 dark:bg-slate-700/10">
            <div class="grid grid-cols-2 text-sm font-semibold text-slate-500 dark:text-slate-400 uppercase tracking-tighter">
                @foreach($items as $item)
                    <div class="flex flex-col p-1 {{ $loop->iteration % 2 != 0 ? 'border-r' : 'pl-2' }} {{ $loop->iteration > 2 ? 'border-t mt-1 pt-2' : '' }} border-gray-300 dark:border-slate-700">
                        <span class="opacity-90">{!! $item['label'] !!}</span>
                        <span class="text-slate-900 dark:text-slate-200 {{ ($item['truncate'] ?? false) ? 'truncate' : '' }}">{{ $item['value'] }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    <nav class="flex-1 flex flex-col {{ request()->routeIs('reports.index') ? 'overflow-y-auto' : 'overflow-hidden' }} px-4 py-2 space-y-2 [scrollbar-width:thin] [scrollbar-color:rgba(107,114,128,0.8)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-500/80">
        <div class="flex-1 space-y-[6px]">
            @if($createNewAction)
                <button wire:click="{{ $createNewAction }}" @class(AuditLogsStyling::getContainerClasses($isCreateSelected)) @disabled($isCreateSelected)>
                    <div class="flex items-center overflow-hidden">
                        <i @class([...AuditLogsStyling::getIconClasses($isCreateSelected), 'fa-pen-to-square text-[30px] max-w-[23px] ml-[9.5px] mr-[1.5px]'])></i>

                        <div class="ml-[14px] overflow-hidden text-left">
                            <span @class(['text-[14px] tracking-normal tabular-nums font-semibold', ...AuditLogsStyling::getTextClasses($isCreateSelected)])>
                                Create New {{ str($title)->singular() }}
                            </span>
                        </div>
                    </div>
                </button>
            @endif

            @foreach($mappedFiles as $data)
                <div class="relative group">
                    <button @if($onFetch) @click="{{ $onFetch }}('{{ $data['id'] }}'); $store.formPreview.activeSubmission = null;" @else wire:click="{{ $fetchAction }}('{{ $data['id'] }}')" @endif @class(AuditLogsStyling::getContainerClasses($data['isSelected'])) @disabled($data['isSelected'])>
                        <div class="flex items-center overflow-hidden">
                            <i @class(AuditLogsStyling::getIconClasses($data['isSelected']))></i>

                            <div class="ml-[13.5px] overflow-hidden text-left w-[11rem]">
                                <p @class(['text-[14px] tracking-normal tabular-nums font-semibold', ...AuditLogsStyling::getTextClasses($data['isSelected'])]) title="{{ $data['displayName'] }}">
                                    {{ $data['displayName'] }}
                                </p>

                                @if($data['fileSize'])
                                    <p class="text-[12px] mt-1 ml-[7.5px] uppercase tracking-wider opacity-80 font-bold leading-none tabular-nums text-slate-700 dark:text-slate-300">
                                        {{ $data['fileSize'] }}
                                    </p>
                                @elseif($data['updatedAt'])
                                    <div class="mt-1 ml-2 text-xs font-semibold uppercase tracking-wider tabular-nums leading-[1.5] text-black dark:text-white">
                                        <div class="opacity-70">{{ $data['updatedAt']->format('M. d, Y') }}</div>
                                        <div class="opacity-50">{{ $data['updatedAt']->format('h:i:s A') }}</div>
                                    </div>
                                @endif
                            </div>
                        </div>

                        @if($deleteAction)
                            <div wire:click.stop="{{ $deleteAction }}({{ $data['id'] }})" wire:confirm="{{ $data['delConfirmMsg'] }}" class="text-slate-600 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-500 mr-[13.5px] transition-colors cursor-pointer" title="Delete">
                                <i class="fa-solid fa-trash-alt text-2xl"></i>
                            </div>
                        @else
                            <div @if($onFetch) @click.stop="$wire.set('loadingAction', 'downloadFile'); $wire.downloadFile('{{ $data['id'] }}')" @else wire:click.stop="{{ $downloadAction }}('{{ $data['id'] }}')" @endif class="text-slate-600 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-500 mr-[13.5px] transition-colors cursor-pointer" title="Download">
                                <i class="fa-solid fa-download text-2xl"></i>
                            </div>
                        @endif
                    </button>
                </div>
            @endforeach
        </div>
    </nav>

    @if($message = AuditLogsStyling::getLoggingMessage())
        <div class="mx-4 mb-4 pt-3 pl-[2px]">
            <span class="font-medium text-[13px] text-black dark:text-white">
                <strong>NOTE</strong>: {{ request()->routeIs('reports.index') ? "You can only create 99 items." : $message }}
            </span>
        </div>
    @endif
</aside>
