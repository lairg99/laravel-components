@props([
    'type' => 'text',
    'disabled' => false,
    'optional' => false,
    'label' => null,
    'highlight' => false,
    'key' => null,
    'multiple' => false,
    'fileName' => 'Datei',
    'isLoading' => true
])

@php

    $key = $key ?? $attributes->get('wire:model') ?? Str::random();
    $error = Arr::first($errors->get($key) ?? []);

    $border = match(true) {
        $highlight => 'border-amber-500',
        $error !== null => 'border-red-500',
        default =>  'border-gray-300 dark:border-gray-900'
    };

@endphp

<div {{ $attributes->only('class') }}>
    @if($label)
        <x-veo::form.label :has-highlight="$highlight" :has-error="$error !== null" for="{{ $key }}" :$optional>{{ $label }}</x-veo::form.label>
    @endif

    <div x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress" x-data="{ files: null, isUploading: false, progress: 0 }" {{ $attributes->merge(['class' => "overflow-hidden w-full cursor-pointer rounded-lg dark:bg-gray-800 shadow-sm border {$border}"]) }}>
        <label class="w-full flex items-center p-2" for="{{ $key }}"> <input type="file" @if($attributes->has('wire:model')) wire:model="{{ $attributes->get('wire:model') }}" @endif class="sr-only" id="{{ $key }}" {{ $multiple ? 'multiple' : '' }} x-on:change="files = Object.values($event.target.files)">
            <div class="pl-4" x-html="files ? files.map(file => '<div class=\'my-1\'>' + file.name + '</div>').join('') : '{{$fileName}} auswählen...'"></div>

            @if($isLoading)
                <i class="fa-solid fa-spinner mx-3 opacity-50"></i>
            @endif

            <div for="customFile" class="ml-auto bg-gray-200 hover:bg-gray-300 dark:bg-gray-700 dark:hover:bg-gray-800 dark:text-gray-100 rounded-md px-3 py-2 text-gray-600 font-bold text-sm" color="tertiary">
                <svg width="24" height="24" fill="none" viewBox="0 0 24 24">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M4.75 14.75V16.25C4.75 17.9069 6.09315 19.25 7.75 19.25H16.25C17.9069 19.25 19.25 17.9069 19.25 16.25V14.75"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 14.25L12 5"></path>
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M8.75 8.25L12 4.75L15.25 8.25"></path>
                </svg>
            </div>
        </label>

        <div class="w-1/2 h-1 bg-red-500" x-bind:class="{ 'bg-red-500': isUploading }" x-bind:style="{ width: `${progress}%` }"></div>
    </div>
</div>
