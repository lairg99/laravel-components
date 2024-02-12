@props(['title'])

@php
    $wire = $attributes->only(['wire:model', 'wire:model.defer', 'wire:model.live'])->first();
@endphp

<label {{ $attributes->except('value') }}>
    <input type="radio" @if($wire) wire:model="{{ $wire }}" name="{{ $wire }}" @endif class="sr-only peer" {{ $attributes->only(['value', 'name', 'checked']) }}/>

    <div @class([
        'rounded-md px-4 py-3 border-2 cursor-pointer',
        'bg-secondary-50 border-secondary-50 hover:border-secondary-200 hover:bg-white',
         'peer-checked:bg-primary-50 peer-checked:text-primary-800 peer-checked:border-primary-300'
    ])>
        <div class="font-bold">{{ $title }}</div>

        <div class="text-sm text-secondary-400">
            {{ $slot }}
        </div>
    </div>
</label>