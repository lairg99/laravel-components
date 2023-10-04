<label {{ $attributes->except(['wire:model', 'value'])->merge(['class' => 'flex items-start']) }}>
    <x-veo::form.checkbox class="mr-4 mt-[3px]" {{ $attributes->only(['wire:model', 'wire:model.defer', 'value']) }}/>

    @if($slot->isNotEmpty())
        <div class="text-gray-600 dark:text-gray-300">
            {{ $slot }}
        </div>
    @endif
</label>