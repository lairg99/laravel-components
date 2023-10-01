@props(['actions' => null, 'withSearch' => false, 'filters' => null])

@if(method_exists($this, 'breadcrumb'))
    @php
        $path = $this->breadcrumb();
    @endphp

    <div class="flex items-center gap-x-3 text-xs my-2">
        <a href="{{ route('dashboard') }}" class="font-bold text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400">
            {{ config('app.name') }}
        </a>

        @foreach($path as $i => [$name, $url])
            <i class="fa-solid fa-chevron-right text-[0.6rem] text-gray-400 dark:text-gray-600"></i>

            <a href="{{ $url }}" @class([
                'font-bold',
                'text-gray-400 dark:text-gray-500 hover:text-gray-500 dark:hover:text-gray-400' => ($i + 1) !== count($path),
                'text-gray-500 dark:text-gray-400 hover:text-gray-700 dark:hover:text-gray-300' => ($i + 1) === count($path),
            ])>
                {{ $name }}
            </a>
        @endforeach
    </div>
@endif

<div {{ $attributes->class(['flex w-full md:items-center flex-col md:flex-row my-8']) }}>
    <h1 class="text-2xl font-bold text-gray-800 dark:text-gray-200">
        {{ $slot }}
    </h1>

    <div class="sm:ml-auto flex flex-row items-center flex-wrap gap-x-3 gap-y-2 mt-2 sm:mt-0">
        @if($actions)
            {{ $actions }}
        @endif
    </div>

    @if($withSearch || $filters)
        <div @class(['flex flex-col sm:items-center sm:flex-row gap-x-3 gap-y-2 mt-3 md:mt-0 sm:pl-5 md:ml-5 sm:ml-auto', 'md:border-l dark:border-gray-700' => $actions !== null])>
            @if($withSearch)
                <div>
                    <x-veo::search input-class="py-1.5" wire:model="search"/>
                </div>
            @endif

            @if($filters)
                {{ $filters }}
            @endif
        </div>
    @endif
</div>