@props(['inputClass' => null])
<div class="relative w-full">
    <x-veo::form.input :input-class="$inputClass" {{ $attributes->merge(['class' => 'flex-1 w-full', 'type' => 'text', 'placeholder' => 'Suchen...']) }} />

    @if($attributes->has('wire:model'))
        <x-spinner color="text-gray-500"
                   wire:target="{{ $attributes->get('wire:model') }}" wire:loading.delay.longer
                   class="absolute right-4 top-1/2 transform -translate-y-1/2"/>
    @endif
</div>
