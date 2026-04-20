@props(['items', 'files', 'selectedFile'])

<x-molecules.sidebars.template-sidebar :items="$items" :files="$files" :selectedFile="$selectedFile" :nameStrip="['google-forms-']" onFetch="$wire.set('loadingAction', 'fetchFile'); $wire.fetchFile" />
