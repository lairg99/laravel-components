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
    'withSpinner' => false,
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

            $wire = $attributes->get('wire:model') ?? $attributes->get('wire:model.defer');
            $keyUpEvent = $attributes->has('x-on:keyup')
                ? 'content = $refs.native.value && ' . $attributes->get('x-on:keyup')
                : 'content = $refs.native.value && ';

        @endphp

        <div class="relative flex-1" x-data="{
            content: $refs.native.value,
            get length() { return this.content.length; }
        }">
            <input x-ref="native" x-on:keyup="{{ $keyUpEvent}}" type="{{ $type }}" {{ $attributes->except(['class', 'x-on:keyup'])->merge(['class' => "{$base} {$border} {$inputClass}"]) }}  {{ $disabled ? 'disabled' : '' }}/>

            <div class="flex items-center gap-x-3 absolute right-4 top-0 bottom-0">
                @if($maxLength = $attributes->get('maxlength'))
                    <div x-cloak class="font-bold text-sm" x-bind:class="{
                        'text-gray-400': length < {{ $maxLength - 1 }},
                        'text-amber-600': length === {{ $maxLength - 1 }},
                        'text-red-700': length === {{ $maxLength}}
                    }">
                        <span x-text="length"></span>/{{ $maxLength }}
                    </div>
                @endif

                @if($clearable)
                    @php
                        $clearAction = $wire
                            ? "content = ''; \$refs.native = ''; \$wire.set('{$wire}', ''); \$focus.focus(\$refs.native)"
                            : "content = ''; \$refs.native = ''; \$focus.focus(\$refs.native)"
                    @endphp

                    <i x-on:click="{{ $clearAction }}" class="fa-solid fa-xmark text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 cursor-pointer"></i>
                @endif

                @if($withSpinner)
                    <i class="fa-solid fa-spinner text-sm text-gray-400 animate-spin" @if($wire) wire:loading.delay.shorter wire:target="{{ $wire }}" @endif></i>
                @endif
            </div>
        </div>

        @if($measure)
            <div class="ml-3 font-bold text-gray-400">
                {{ $measure }}
            </div>
        @endif
    </div>

    @if($hint)
        <x-veo::form.hint>{{ $hint }}</x-veo::form.hint>
    @endif
</div>
