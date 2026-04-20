<x-templates.personal-pages :title="$title ?? null" :type="$type ?? null" :padding="$padding ?? '20px'" :important="$important ?? ''">
    {{ $slot }}
</x-templates.personal-pages>
