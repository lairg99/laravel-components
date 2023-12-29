@props(['actions' => null, 'withSearch' => false, 'filters' => null])

<div {{ $attributes->class(['flex w-full md:items-center flex-col md:flex-row my-5']) }}>
    <h3 class="text-[1.05rem] font-bold text-gray-600 dark:text-gray-200">
        {{ $slot }}
    </h3>

    <div class="md:ml-auto flex flex-row items-center flex-wrap gap-x-3 gap-y-2 mt-2 sm:mt-0 md:mr-5">
        @if($actions)
            {{ $actions }}
        @endif
    </div>

    @if($withSearch || $filters)
        <div @class(['flex items-center flex-row gap-x-3 gap-y-2 mt-3 md:mt-0 md:pl-5 md:ml-auto mb-3 md:mb-0', 'md:border-l dark:border-gray-700' => $actions !== null])>
            @if($withSearch)
                <div>
                    <x-veo::form.input wire:model="search" input-class="py-1.5" class="md:max-w-[200px]" with-spinner/>
                </div>
            @endif

            @if($filters)
                {{ $filters }}
            @endif
        </div>
    @endif
</div>