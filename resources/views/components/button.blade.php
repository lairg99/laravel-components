@props(['color' => 'primary', 'icon' => null, 'size' => null, 'spinner' => null, 'disabled' => false])

@php
    $colorStyle = match($color) {
        'primary' => 'bg-primary-100 border hover:bg-primary-200 focus:ring-primary-500 text-primary-600',
        'secondary' => 'bg-gray-100 hover:bg-gray-300 text-secondary-400 focus:ring-gray-300',
        'tertiary' => 'bg-none hover:bg-secondary-50 text-secondary-300 hover:text-secondary-400 focus:ring-secondary-300',
        'warning' => 'bg-amber-100 hover:bg-amber-200 focus:ring-amber-400 text-amber-600',
        'danger' => 'bg-red-100 hover:bg-red-200 focus:ring-red-400 text-red-600',
        'success' => 'bg-lime-100 hover:bg-lime-200 focus:ring-lime-400 text-lime-600',
        'neutral' => 'bg-white hover:bg-gray-100 text-secondary-400 hover:text-secondary-500 focus:ring-gray-300',
    };

    $sizeStyle = match($size) {
       'xl' => 'py-4 px-10 text-[1rem]',
       'lg' => 'py-2 px-4 text-[0.95rem]',
       'sm' => 'text-sm py-0.5 px-1.5',
        default => 'text-sm py-1.5 px-3.5',
    };

    $iconSizeStyle = match($size) {
        default => 'text-xs'
    };

    $iconColorStyle = match($color) {
        'primary' => 'text-primary-400',
        'secondary' => 'text-secondary-300',
        'tertiary' => 'text-secondary-200',
        'warning' => 'bg-amber-100 hover:bg-amber-200 focus:ring-amber-400 text-amber-600',
        'danger' => 'bg-red-100 hover:bg-red-200 focus:ring-red-400 text-red-600',
        'success' => 'bg-lime-100 hover:bg-lime-200 focus:ring-lime-400 text-lime-600',
        'neutral' => 'text-secondary-300',
    };

    $disabledStyle = match($disabled) {
        true => 'opacity-60 cursor-not-allowed',
        default => ''
    };

    $spinnerColor = match($color) {
        'secondary', 'tertiary' => 'dark',
        default => 'light'
    };

@endphp

<button wire:loading.attr="disabled" {{ $attributes->merge(['type' => 'submit', 'class' => "inline-flex items-center justify-center border border-transparent whitespace-nowrap font-bold rounded focus:outline-none focus:ring-2 focus:ring-offset-2 {$colorStyle} {$sizeStyle} {$disabledStyle}"]) }} @if($disabled) disabled @endif>
    @if($icon)
        <i class="fa-solid fa-{{ $icon }} mr-1.5 {{ $iconSizeStyle }} {{ $iconColorStyle }}"></i>
    @endif

    <span>
        {{ $slot }}
    </span>
</button>
