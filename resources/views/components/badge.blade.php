@props(['color' => 'primary', 'label' => null, 'size' => null, 'loading' => false])

@php
    $colorStyle = match($color) {
        'primary', 'red'                 => 'bg-primary-200 text-primary-900 dark:bg-primary-800 dark:text-primary-100',
        'red'                            => 'bg-red-200     text-red-900     dark:bg-red-800     dark:text-red-100',
        'secondary', 'tertiary', 'gray'  => 'bg-gray-200    text-gray-700    dark:bg-gray-900    dark:text-gray-200',
        'green', 'lime'                  => 'bg-lime-200    text-lime-900    dark:bg-lime-700    dark:text-lime-100',
        'yellow', 'amber'                => 'bg-amber-200   text-amber-800   dark:bg-amber-600   dark:text-amber-100',
        'orange'                         => 'bg-orange-200  text-orange-800  dark:bg-orange-600  dark:text-orange-100',
        'blue', 'sky'                    => 'bg-sky-200     text-sky-800     dark:bg-sky-700     dark:text-sky-100',
        'purple'                         => 'bg-purple-200  text-purple-800  dark:bg-purple-600  dark:text-purple-100',
        'pink'                           => 'bg-pink-200    text-pink-800    dark:bg-pink-600    dark:text-pink-100',
    };

    $sizeStyle = match($size) {
        'sm' => 'px-2 py-0 text-2xs',
        default => 'px-2.5 py-0.5 text-xs'
    };

@endphp

<div {{ $attributes->merge(['class' => "inline-flex justify-center font-bold rounded-full whitespace-nowrap {$sizeStyle} {$colorStyle}"]) }}>
    @if($label)
        <span class="font-normal mr-1">{{ $label }} |</span>
    @endif

    {{ $slot }}

    @if($loading)
        <div class="ml-1 -mt-[1px]">
            <i class="fa-solid fa-spinner text-2xs animate-spin"></i>
        </div>
    @endif
</div>
