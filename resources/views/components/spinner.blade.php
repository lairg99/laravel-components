@props(['alwaysShow' => false])

<span class="text-gray-600">
    <i @if(! $alwaysShow) wire:loading @endif {{ $attributes->merge(['class' => 'fa-solid fa-spinner animate-spin inline-block']) }}></i>
</span>
