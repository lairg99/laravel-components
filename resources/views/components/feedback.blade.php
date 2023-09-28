@props(['type', 'size' => null, 'icon' => null])

@php
    $type ??= 'success';

    $color = match($type) {
        'danger' =>  'bg-red-100   text-red-800   dark:bg-red-700   dark:text-red-100',
        'success' => 'bg-lime-100  text-lime-800  dark:bg-lime-700  dark:text-lime-100',
        'warning' => 'bg-amber-100 text-amber-800 dark:bg-amber-700 dark:text-amber-100',
        'info' =>    'bg-gray-200  text-gray-700  dark:bg-gray-700  dark:text-gray-100',
    };

    $iconColor = match($type) {
        'danger' =>  'text-red-400   dark:text-red-300',
        'success' => 'text-lime-500  dark:text-lime-400',
        'warning' => 'text-amber-500 dark:text-amber-400',
        'info' =>    'text-gray-400',
    };

    $size = match($size) {
        'sm' => 'py-2 px-4 my-4 text-sm',
        default => 'py-3 px-5 my-4'
    };

    $iconSize = match($size) {
        'sm' => 'text-xs mr-2',
        default => 'text-sm mr-3'
    };

    $icon = $icon ?? match($type) {
        'danger', 'warning' => 'triangle-exclamation',
        'success' => 'check-double',
        'info' => 'circle-info'
    };
@endphp

<div {{ $attributes->merge(['class' => "rounded-md {$color} {$size} flex items-center"]) }}>
    @if($icon !== 'none')
        <i class="fa-solid inline-block fa-{{ $icon }} {{ $iconColor }} {{ $iconSize }}"></i>
    @endif

    <div class="">
        {{ $slot }}
    </div>
</div>
