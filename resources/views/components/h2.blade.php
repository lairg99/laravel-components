@props(['actions' => null, 'withSearch' => false, 'filters' => null])

<div {{ $attributes->class(['flex w-full md:items-center flex-col md:flex-row mt-5 sm:mt-7 mb-4 sm:mb-5 gap-y-3']) }}>
    <h2 class="text-xl font-bold text-gray-800 dark:text-gray-200">
        {{ $slot }}
    </h2>

    @if($actions)
        <div class="sm:ml-auto flex flex-row items-center flex-wrap gap-x-3 gap-y-2 sm:mt-0">
            {{ $actions }}
        </div>
    @endif

    @if($withSearch || $filters)
        <div @class(['flex items-center flex-row gap-x-3 gap-y-2 mt-3 md:mt-0 md:pl-5 mb-3 md:mb-0 ml-0 md:ml-5', 'md:border-l dark:border-gray-700' => $actions !== null])>
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