<label {{ $attributes->except(['wire:model', 'value'])->merge(['class' => 'flex items-start']) }}>
    <x-veo::form.radio class="mr-4 mt-[4px]" {{ $attributes->only(['wire:model', 'wire:model.defer', 'value', 'name']) }}/>

    @if($slot->isNotEmpty())
        <div class="text-gray-600 dark:text-gray-300">
            {{ $slot }}
        </div>
    @endif
</label>