@props(['items', 'files', 'selectedFile', 'sizeFormatted' => null, 'nameStrip' => [], 'fetchAction' => null, 'downloadAction' => null, 'onFetch' => null])

@use('App\Enums\NonDB\AuditLogsStyling')
@use('Illuminate\Support\Reflector')

<aside class="w-72 bg-white dark:bg-slate-800 border-r-2 border-gray-300 dark:border-slate-700 flex flex-col h-full">
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

    <nav class="flex-1 flex flex-col {{ request()->routeIs('submissions.index') ? 'overflow-y-auto' : 'overflow-hidden' }} px-4 py-2 space-y-2">
        <div class="flex-1 space-y-[6px]">
            @foreach($files as $file)
                @php
                    $isSelected = $selectedFile && $selectedFile->name === $file->name;
                    $displayName = str($file->name)->replace($nameStrip, '');
                    $fileSize = Reflector::isCallable([$file, 'sizeFormatted']) ? $file->sizeFormatted() : ($file->sizeFormatted ?? '');
                @endphp

                <div class="relative">
                    <button @if($onFetch) @click="{{ $onFetch }}('{{ $file->name }}'); $store.formPreview.activeSubmission = null;" @else wire:click="{{ $fetchAction ?? 'fetchFile' }}('{{ $file->name }}')" @endif @class(AuditLogsStyling::getContainerClasses($isSelected)) @disabled($isSelected)>
                        <div class="flex items-center overflow-hidden">
                            <i @class(AuditLogsStyling::getIconClasses($isSelected))></i>

                            <div class="ml-[13.5px] overflow-hidden text-left w-[11rem]">
                                <p @class(['text-[14px] tracking-normal tabular-nums font-semibold truncate', ...AuditLogsStyling::getTextClasses($isSelected)]) title="{{ $file->name }}">
                                    {{ $displayName }}
                                </p>

                                <p class="text-[12px] mt-1 ml-[7.5px] uppercase tracking-wider opacity-80 font-bold leading-none tabular-nums text-slate-700 dark:text-slate-300">
                                    {{ $fileSize }}
                                </p>
                            </div>
                        </div>

                        <div @if($onFetch) @click.stop="$wire.set('loadingAction', 'downloadFile'); $wire.downloadFile('{{ $file->name }}')" @else wire:click.stop="{{ $downloadAction ?? 'downloadFile' }}('{{ $file->name }}')" @endif class="text-slate-600 dark:text-slate-400 hover:text-emerald-600 dark:hover:text-emerald-500 mr-[13.5px] transition-colors cursor-pointer" title="Download log file.">
                            <i class="fa-solid fa-download text-2xl"></i>
                        </div>
                    </button>
                </div>
            @endforeach
        </div>
    </nav>

    @if($message = AuditLogsStyling::getLoggingMessage())
        <div class="mx-4 mb-4 pl-[2px]">
            <span class="font-medium text-[13px] text-black dark:text-white">
                <strong>NOTE</strong>: {{ $message }}
            </span>
        </div>
    @endif
</aside>
