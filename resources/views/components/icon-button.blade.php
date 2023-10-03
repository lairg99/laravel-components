@props(['icon', 'size' => null, 'color' => 'primary', 'type' => 'button'])

@php

    $baseStyle = 'inline-block cursor-pointer rounded-md transition duration-150 transform active:scale-125 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800';

    $sizeStyle = 'py-1 px-1.5 text-xs';

    $colorStyle = match($color) {
        'primary' =>   'bg-red-100  hover:bg-red-200  text-red-800  focus:ring-red-300  dark:bg-red-800  dark:hover:bg-red-700  dark:text-gray-100 dark:focus:ring-red-700',
        'secondary' => 'bg-gray-200 hover:bg-gray-300 text-gray-700 focus:ring-gray-400 dark:bg-gray-800 dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-700',
        'tertiary' =>  'bg-none     hover:bg-gray-200 text-gray-600 focus:ring-gray-300 dark:none        dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-600',
        'neutral' =>   'bg-white    hover:bg-gray-100 text-gray-600 focus:ring-gray-300 dark:bg-gray-900 dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-600',
    };

    $wire = $attributes->get('wire:click');

@endphp

<button type="{{ $type }}" {{ $attributes->merge(['class' => "{$baseStyle} {$sizeStyle} {$colorStyle}"]) }}>
    <i @if($wire) wire:loading.remove wire:target="{{ $wire }}" @endif class="fa-regular fa-fw fa-{{ $icon }}"></i>

    @if($wire)
        <i wire:loading wire:target="{{ $wire }}" class="fa-solid fa-fw fa-spinner animate-spin"></i>
    @endif
</button>
