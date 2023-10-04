@props(['value'])

@php

    $baseStyle = 'inline-block cursor-pointer relative -top-0.5 rounded-md transition duration-150 transform active:scale-125 focus:outline-none focus:ring-2 focus:ring-offset-2 dark:focus:ring-offset-gray-800';

    $sizeStyle = 'py-1 px-1.5 text-xs';

    $colorStyle = 'bg-none hover:bg-gray-200 text-gray-400 focus:ring-gray-300 dark:none dark:hover:bg-gray-900 dark:text-gray-100 dark:focus:ring-gray-600';

    $wire = $attributes->get('wire:click');

@endphp

<div x-data="{ copied: false }" @click="copied = true; window.navigator.clipboard.writeText('{{ $value }}');" {{ $attributes->merge(['class' => 'inline-block mx-1']) }}>
    <button type="button" {{ $attributes->merge(['class' => "{$baseStyle} {$sizeStyle} {$colorStyle}"]) }}>
        <template x-if="copied == false">
            <i class="fa-regular fa-fw fa-copy"></i>
        </template>
        <template x-if="copied == true">
            <i class="fa-solid fa-fw fa-check"></i>
        </template>
    </button>
</div>
