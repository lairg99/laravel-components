@props([
    'color' => 'primary',
    'size' => null,
    'icon' => null,
    'spinner' => null,
    'disabled' => false,
    'route' => null,
    'can' => null,
    'type' => 'button'
])

@php
    $baseStyle = 'group whitespace-nowrap transition duration-150 inline-flex items-center justify-center border font-bold rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800 active:outline-none active:ring-2 active:ring-offset-2 dark:active:ring-offset-gray-800';

    $colorStyle = match($color) {
        'primary' =>   'bg-primary-100  border-primary-100  hover:bg-primary-200  text-primary-700  focus:ring-primary-300 active:ring-primary-300  dark:bg-primary-800  dark:border-primary-800  dark:hover:bg-primary-700  dark:text-gray-100 dark:focus:ring-primary-700 dark:active:ring-primary-700',
        'secondary' => 'bg-gray-200     border-gray-200     hover:bg-gray-300     text-gray-700     focus:ring-gray-400    active:ring-gray-400     dark:bg-gray-800     dark:border-gray-800     dark:hover:bg-gray-900     dark:text-gray-100 dark:focus:ring-gray-700    dark:active:ring-gray-700',
        'tertiary' =>  'bg-none         border-none         hover:bg-gray-200     text-gray-500     focus:ring-gray-300    active:ring-gray-300     dark:none            dark:border-none         dark:hover:bg-gray-900     dark:text-gray-100 dark:focus:ring-gray-600    dark:active:ring-gray-600',
        'neutral' =>   'bg-white        border-white        hover:bg-gray-100     text-gray-600     focus:ring-gray-300    active:ring-gray-300     dark:bg-gray-900     dark:border-gray-900     dark:hover:bg-gray-900     dark:text-gray-100 dark:focus:ring-gray-600    dark:active:ring-gray-600',
    };

    $iconColorStyle = match($color) {
        'primary' =>               'text-primary-300  group-hover:text-primary-400',
        'secondary', 'tertiary' => 'text-gray-400     group-hover:text-gray-500',
        'neutral' =>               'text-gray-400     group-hover:text-gray-400',
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
        'primary' => 'text-primary-400',
        default => 'text-gray-400'
    };

@endphp

@if(! $can || auth()->user()->can(... $can))
    <button type="{{ $type }}" @if($route) onclick="window.location.href='{{ $route }}';" @endif wire:loading.attr="disabled" {{ $attributes->merge(['class' => "{$baseStyle} {$colorStyle} {$sizeStyle} {$disabledStyle}"]) }} @if($disabled) disabled @endif>
        @if($icon)
            <i class="fa-solid fa-fw fa-{{ $icon }} {{ $iconColorStyle }} {{ $iconSizeStyle }}"></i>
        @endif

        {{ $slot }}

        @if($spinner)
            {{ $spinner }}
        @else
            @if($attributes->has('wire:click'))
                <x-veo::spinner wire:target="{{ $attributes->get('wire:click') }}" :color="$spinnerColor" :class='"ml-2 {$spinnerColor}"'/>
            @endif
        @endif
    </button>
@endif
