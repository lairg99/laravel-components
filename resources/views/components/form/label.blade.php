@props([
    'value',
    'optional' => false,
    'hasError' => false,
    'hasHighlight' => false
])

@php

    $colorStyle = match(true) {
        $hasHighlight => 'text-amber-700',
        $hasError => 'text-red-700',
        default => 'text-gray-700 dark:text-gray-300',
    };

@endphp

<label {{ $attributes->merge(['class' => "block font-medium text-sm mb-1 {$colorStyle}"]) }}>
    {{ $value ?? $slot }}

    @if($hasError)
        <i class="fa-solid fa-triangle-exclamation text-xs ml-1 text-red-700"></i>
    @endif

    @if($optional)
        <span class="text-2xs">optional</span>
    @endif
</label>
