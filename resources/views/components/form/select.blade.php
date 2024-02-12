@props([
    'type' => 'text',
    'disabled' => false,
    'optional' => false,
    'label' => null,
    'highlight' => false,
    'selectClass' => null
])

@php

    $key = $key ?? $attributes->only(['wire:model', 'wire:model.defer', 'wire:model.live'])->first() ?? \Illuminate\Support\Str::random();
    $error = \Illuminate\Support\Arr::first($errors->get($key) ?? []);

    $base = 'block dark:bg-gray-800 w-full rounded-md shadow-sm focus:ring focus:ring-opacity-50';

    if($disabled) {
        $base .= ' bg-gray-100';
    }

    $border = match(true) {
        $highlight =>      'border-amber-500 focus:border-amber-300   focus:ring-amber-200',
        $error !== null => 'border-red-500   focus:border-red-300     focus:ring-red-200',
        default =>         'border-gray-300  focus:border-primary-300 focus:ring-primary-200 dark:border-gray-900 dark:focus:border-gray-600 dark:focus:ring-gray-900'
    };

@endphp

<div {{ $attributes->only('class') }}>
    @if($label)
        <x-veo::form.label :has-highlight="$highlight" :has-error="$error !== null" for="{{ $key }}" :$optional>{{ $label }}</x-veo::form.label>
    @endif

    <select {{ $attributes->except('class')->merge(['class' => "{$base} {$border} {$selectClass}"]) }} id="{{ $key }}" {{ $disabled ? 'disabled' : '' }} {{ $optional ? '' : 'required' }}>
        {{ $slot }}
    </select>
</div>
