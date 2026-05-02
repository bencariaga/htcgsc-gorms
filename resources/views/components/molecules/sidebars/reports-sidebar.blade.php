@props(['files' => [], 'selectedFile' => null])

@use('App\Enums\NonDB\AuditLogsStyling')

<aside class="w-72 bg-white dark:bg-slate-800 border-r-2 border-gray-300 dark:border-slate-700 flex flex-col h-full">
    <nav class="flex-1 flex flex-col overflow-y-auto px-4 py-2 space-y-2">
        <div class="flex-1 space-y-[6px]">
            @php $isCreateSelected = $selectedFile === null; @endphp

            <button wire:click="createNewReport" @class(AuditLogsStyling::getContainerClasses($isCreateSelected)) @disabled($isCreateSelected)>
                <div class="flex items-center overflow-hidden">
                    <i @class([...AuditLogsStyling::getIconClasses($isCreateSelected), 'fa-pen-to-square text-[30px] max-w-[23px] ml-[9.5px] mr-[1.5px]'])></i>

                    <div class="ml-[14px] overflow-hidden text-left">
                        <span @class(['text-[14px] tracking-normal tabular-nums font-semibold truncate', ...AuditLogsStyling::getTextClasses($isCreateSelected)])>
                            Create New Report
                        </span>
                    </div>
                </div>
            </button>

            @foreach ($files as $report)
                @php
                    $isSelected = $selectedFile && $selectedFile->report_id === $report->report_id;
                    $delConfirmMsg = "Are you sure you want to delete this report?\n\"{$report->title}\"";
                @endphp

                <div class="relative group">
                    <button wire:click="selectReport({{ $report->report_id }})" @class(AuditLogsStyling::getContainerClasses($isSelected)) @disabled($isSelected)>
                        <div class="flex items-center overflow-hidden">
                            <i @class(AuditLogsStyling::getIconClasses($isSelected))></i>

                            <div class="ml-[14px] overflow-hidden text-left w-[11rem]">
                                <p @class(['text-[14px] tracking-normal tabular-nums font-semibold truncate', ...AuditLogsStyling::getTextClasses($isSelected)]) title="{{ $report->title }}">
                                    {{ $report->title }}
                                </p>

                                <div class="mt-1 ml-2 text-xs font-semibold uppercase tracking-wider tabular-nums leading-[1.5] text-black dark:text-white">
                                    <div class="opacity-70">{{ $report->updated_at->format('M. d, Y') }}</div>
                                    <div class="opacity-50">{{ $report->updated_at->format('h:i:s A') }}</div>
                                </div>
                            </div>
                        </div>

                        <div wire:click.stop="deleteReport({{ $report->report_id }})" wire:confirm="{{ $delConfirmMsg }}" class="text-slate-600 dark:text-slate-400 hover:text-red-600 dark:hover:text-red-500 mr-[13.5px] transition-colors cursor-pointer" title="Delete report">
                            <i class="fa-solid fa-trash-alt text-2xl"></i>
                        </div>
                    </button>
                </div>
            @endforeach
        </div>
    </nav>

    <div class="mx-4 mb-4 pl-[2px]">
        <span class="font-medium text-[13px] text-black dark:text-white">
            <strong>NOTE</strong>: You can only create 99 reports.
        </span>
    </div>
</aside>
