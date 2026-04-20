@props(['filter', 'logs', 'type', 'perPage', 'appInfo', 'files', 'selectedFile', 'isReloading', 'processingFileName', 'selectedFileName'])

@use('App\Enums\NonDB\AuditLogsStyling')

<div class="flex h-full overflow-hidden">
    @if($isReloading) <div wire:poll.1s="checkReloadStatus"></div> @endif

    @foreach (AuditLogsStyling::loadingTargets() as $target => $message)
        <div wire:loading wire:target="{{ $target }}">
            <x-molecules.loading-screens.ls-livewire :message="$message" />
        </div>
    @endforeach

    <x-molecules.sidebars.audit-logs-sidebar :items="$appInfo" :$files :$selectedFile />

    <main class="flex-1 flex flex-col min-w-0 overflow-y-auto [scrollbar-width:thin] [scrollbar-color:rgba(107,114,128,0.8)_transparent] [&::-webkit-scrollbar]:w-1 [&::-webkit-scrollbar-thumb]:rounded-full [&::-webkit-scrollbar-thumb]:bg-gray-500/80">
        <x-pages.list-type :items="$logs" type="audit-log" :perPage="$perPage" sortField="datetime" sortDirection="desc" idColumn="datetime" alphaColumn="message" :filter="$filter" :selectedFileName="$selectedFileName" :columns="['Type', 'Date and Time', 'Message']" />
    </main>
</div>

<script src="{{ asset('js/audit-logs.js') }}"></script>
