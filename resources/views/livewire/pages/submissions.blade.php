@props(['filter', 'logs', 'type', 'perPage', 'appInfo', 'files', 'selectedFile', 'selectedFileName', 'submissions', 'renderedSubmissions', 'contactReferrer', 'newTab', 'items', 'gfs', 'sbms'])

@use('App\Enums\NonDB\SubmissionsStyling')

<div class="flex h-full overflow-hidden bg-white text-black" x-data="{ loadingType: '' }">
    @foreach (SubmissionsStyling::loadingTargets() as $target => $message)
        <div wire:loading wire:target="{{ $target }}">
            <x-molecules.loading-screens.ls-livewire :message="$message" />
        </div>
    @endforeach

    <x-molecules.sidebars.submissions-sidebar :$items :$files :$selectedFile />
    <x-molecules.forms.google-form :$gfs :$selectedFileName :$submissions :$contactReferrer :$newTab />
    <x-organisms.main.submissions-body :$sbms :$submissions :$renderedSubmissions :$selectedFileName />
</div>

<script src="{{ asset('js/submissions.js') }}"></script>
