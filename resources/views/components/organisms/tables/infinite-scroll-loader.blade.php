@if($perPage === 'all' && $data->hasMorePages())
    <div x-data x-intersect="$wire.loadMore()" class="p-6 flex flex-col items-center justify-center">
        <x-atoms.utility.spinner />
    </div>
@endif
