@props(['columns'])

<thead class="bg-slate-300/30 dark:bg-slate-700/50 text-slate-500 dark:text-slate-400 uppercase text-sm font-black tracking-widest border-b-2 border-gray-300 dark:border-slate-700">
    <tr {{ $attributes->merge(['class' => '']) }}>
        @foreach($columns as $column)
            <th @class(['px-6 py-3 text-left' => !$loop->last, 'p-4 text-center' => $loop->last])>{{ $column }}</th>
        @endforeach
    </tr>
</thead>
