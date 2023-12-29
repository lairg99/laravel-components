@props(['actions' => null, 'badges' => null, 'withSearch' => false, 'filters' => null])

<div {{ $attributes->class(['flex w-full md:items-center flex-col md:flex-row my-8']) }}>
    <div class="flex flex-col lg:flex-row lg:items-center">
        <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
            {{ $slot }}
        </h1>
        @if($badges)
            <div class="mt-2 mb-4 sm:mb-0 lg:mt-0 lg:ml-5 flex gap-x-2">
                {{ $badges }}
            </div>
        @endif
    </div>

    @if($actions)
        <div class="sm:ml-auto flex flex-row items-center flex-wrap gap-x-3 gap-y-2 mt-2 sm:mt-0">
            {{ $actions }}
        </div>
    @endif

    @if($withSearch || $filters)
        <div @class(['flex items-center flex-row gap-x-3 gap-y-2 mt-3 md:mt-0 md:pl-5 md:ml-auto mb-3 md:mb-0', 'md:border-l dark:border-gray-700' => $actions !== null])>
            @if($withSearch)
                <div class="-my-4 flex-1">
                    <x-veo::form.input wire:model="search" class="py-1.5" placeholder="Suchen ..." with-spinner/>
                </div>
            @endif

            @if($filters)
                {{ $filters }}
            @endif
        </div>
    @endif
</div>