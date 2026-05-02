@use('App\Enums\NonDB\ReportFormStyling')

<div class="flex h-full overflow-y-auto">
    @foreach (ReportFormStyling::loadingTargets() as $target => $message)
        <div wire:loading wire:target="{{ $target }}">
            <x-molecules.loading-screens.ls-livewire :message="$message" />
        </div>
    @endforeach

    <x-molecules.sidebars.reports-sidebar :files="$files ?? []" :selectedFile="$selectedFile" />
    <x-molecules.forms.report-form :$initialState :$preloadedData :$selectedFile :$jsFields :$jsFormats :$actionHeader :$fields :$categories :$today :$formats :$actions />
</div>

<script src="{{ asset('js/reports.js') }}" defer></script>
