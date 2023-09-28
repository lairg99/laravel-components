@props([
    'type' => 'text',
    'inputClass' => null,
    'disabled' => false,
    'optional' => false,
    'label' => null,
    'highlight' => null,
    'key' => null,
    'value' => null,
    'measure' => null,
    'clearable' => false
])

@php

    $key = $key ?? $attributes->get('wire:model') ?? \Illuminate\Support\Str::random();
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

    <div class="flex items-center">
        <div class="relative flex-1" x-data>
            <input x-ref="input" type="{{ $type }}" {{ $attributes->except('class')->merge(['class' => "{$base} {$border} {$inputClass}"]) }} id="{{ $key }}" {{ $disabled ? 'disabled' : '' }}/>

            @if($clearable)
                @php
                    $action = $attributes->get('wire:model')
                        ? "\$refs.input.value = null && \$wire.set('{$attributes->get('wire:model')}', null)"
                        : '$refs.input.value = null';
                @endphp

                <i x-show="$refs.input.value.length > 0" class="fa-solid fa-xmark absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 cursor-pointer" x-on:click="{{ $action }}"></i>
            @endif
        </div>

        @if($measure)
            <div class="ml-3 font-bold text-gray-400">
                {{ $measure }}
            </div>
        @endif
    </div>
</div>
