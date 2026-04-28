@props(['items', 'files', 'selectedFile'])

<x-molecules.sidebars.template-sidebar :items="$items" :files="$files" :selectedFile="$selectedFile" :nameStrip="['laravel-']" />
