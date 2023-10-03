@props(['alwaysShow' => false])

<span class="text-gray-600">
    <i class="fa-solid fa-spinner animate-spin" @if(! $alwaysShow) wire:loading @endif {{ $attributes }}></i>
</span>
