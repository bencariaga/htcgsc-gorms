@props(['icon'])

<i {{ $attributes->merge(['class' => "fas {$icon} absolute left-4 text-slate-400"]) }}></i>
