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
    'clearable' => false,
    'hint' => null,
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
        @php
            $definition = "''";

            if($wire = $attributes->get('wire:model')) {
                $definition = "window.Livewire.find('{$this->id}').entangle('{$wire}')";
            }

            if($wire = $attributes->get('wire:model.defer')) {
                $definition = "window.Livewire.find('{$this->id}').entangle('{$wire}').defer";
            }
        @endphp

        <div class="relative flex-1" x-data="{ input: {{ $definition }} }">
            <input x-model="input" x-ref="input" type="{{ $type }}" {{ $attributes->except(['class', 'wire:model'])->merge(['class' => "{$base} {$border} {$inputClass}"]) }} id="{{ $key }}" {{ $disabled ? 'disabled' : '' }}/>

            <div class="flex items-center gap-x-3 absolute right-4 top-0 bottom-0" x-cloak>
                @if($maxLength = $attributes->get('maxlength'))
                    <div x-show="input.length" class="font-bold text-sm" x-bind:class="{
                        'text-gray-400': input.length < {{ $maxLength - 1 }},
                        'text-amber-600': input.length === {{ $maxLength - 1 }},
                        'text-red-700': input.length === {{ $maxLength}}
                    }">
                        <span x-text="input.length"></span>/{{ $maxLength }}
                    </div>
                @endif

                @if($clearable)
                    <i x-on:click="input = ''; $focus.focus($refs.input)" class="fa-solid fa-xmark text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 cursor-pointer"></i>
                @endif
            </div>
        </div>

        @if($measure)
            <div class="ml-3 font-bold text-gray-400">
                {{ $measure }}
            </div>
        @endif
    </div>
</div>
