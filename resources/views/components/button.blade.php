@props([
    'color' => 'primary',
    'size' => null,
    'icon' => null,
    'spinner' => null,
    'disabled' => false,
    'route' => null,
    'can' => null
])

@php
    $baseStyle = 'group transition duration-150 inline-flex items-center justify-center border font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800';

    $colorStyle = match($color) {
        'primary' =>   'bg-red-100  border-red-100  hover:bg-red-200  text-red-800  focus:ring-red-300  dark:bg-red-800  dark:border-red-800  dark:hover:bg-red-700  dark:text-gray-100 dark:focus:ring-red-700',
        'secondary' => 'bg-gray-200 border-gray-200 hover:bg-gray-300 text-gray-700 focus:ring-gray-400 dark:bg-gray-800 dark:border-gray-800 dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-700',
        'tertiary' =>  'bg-none     border-none     hover:bg-gray-200 text-gray-600 focus:ring-gray-300 dark:none        dark:border-none     dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-600',
        'neutral' =>   'bg-white    border-white    hover:bg-gray-100 text-gray-600 focus:ring-gray-300 dark:bg-gray-900 dark:border-gray-900 dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-600',
    };

    $iconColorStyle = match($color) {
        'primary' =>               'text-red-300  group-hover:text-red-400',
        'secondary', 'tertiary' => 'text-gray-400 group-hover:text-gray-500',
        'neutral' =>               'text-gray-400 group-hover:text-gray-400',
    };

    $sizeStyle = match($size) {
        'lg' => 'py-2 px-6 text-lg',
        'sm' => 'py-0.5 px-3 text-sm',
        default => 'py-1.5 px-4'
    };

    $iconSizeStyle = match($size) {
        'lg' => 'text-xs mr-2.5',
        'sm' => 'text-2xs mr-1',
        default => 'text-2xs mr-1.5'
    };

    $disabledStyle = match($disabled) {
        true => 'bg-opacity-30 cursor-not-allowed',
        default => ''
    };

    $spinnerColor = match($color) {
        'primary' => 'text-red-400',
        default => 'text-gray-400'
    };

@endphp

@if(! $can || auth()->user()->can(... $can))
    <button @if($route) onclick="window.location.href='{{ $route }}';" @endif wire:loading.attr="disabled" {{ $attributes->merge(['class' => "{$baseStyle} {$colorStyle} {$sizeStyle} {$disabledStyle}"]) }} @if($disabled) disabled @endif>
        @if($icon)
            <i class="fa-solid fa-fw fa-{{ $icon }} {{ $iconColorStyle }} {{ $iconSizeStyle }}"></i>
        @endif

        {{ $slot }}

        @if($spinner)
            {{ $spinner }}
        @else
            @if($attributes->has('wire:click'))
                <x-spinner wire:target="{{ $attributes->get('wire:click') }}" :color="$spinnerColor" class="ml-2"/>
            @endif
        @endif
    </button>
@endif
