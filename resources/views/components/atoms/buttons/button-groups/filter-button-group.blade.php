@if($settings['filters'])
    <footer class="fixed bottom-0 right-0 z-20 h-[5rem] p-2 transition-all duration-300 ease-in-out" :class="sidebarOpen ? '{{ $settings['open'] }}' : '{{ $settings['closed'] }}'" x-cloak>
        <div class="flex flex-row justify-start items-center gap-4 px-6 py-2 ml-4 mb-2 w-fit bg-gray-200 dark:bg-gray-800 border-2 border-gray-300 dark:border-gray-700 rounded-md shadow-sm">
            <div class="font-medium text-lg text-black dark:text-white">
                {{ $settings['filters']['label'] }}' Filters:
            </div>

            <div class="inline-flex rounded-md shadow-sm" role="group">
                @foreach($settings['filters']['options'] as $option)
                    <button type="button" @if($type === 'audit-logs') wire:click="$set('filter', '{{ $option }}'); triggerGracefulRefresh()" @else wire:click="$set('filter', '{{ $option }}'); $dispatch('filterUpdated')" @endif wire:loading.attr="disabled" @disabled($filter === $option) @class(['px-4 py-2 text-sm font-medium border transition-colors duration-200', 'bg-blue-600 dark:bg-blue-500 text-white border-blue-600 dark:border-blue-500 z-10' => $filter === $option, 'bg-white dark:bg-gray-700 text-black dark:text-gray-200 border-1 border-gray-400 dark:border-gray-600 hover:bg-gray-200 dark:hover:bg-gray-600 disabled:opacity-100 disabled:cursor-default' => $filter !== $option, 'rounded-l-lg' => $loop->first, 'rounded-r-lg' => $loop->last, '-ml-px' => !$loop->first])>
                        {{ $option }}
                    </button>
                @endforeach
            </div>
        </div>
    </footer>
@endif
