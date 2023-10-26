<label {{ $attributes->except(['wire:model', 'value'])->merge(['class' => 'flex items-start w-full']) }}>

    @if($slot->isNotEmpty())
        <div class="text-gray-600 dark:text-gray-300">
            {{ $slot }}
        </div>
    @endif

    <div class="ml-auto">
        <x-veo::form.toggle {{ $attributes->only(['wire:model', 'wire:model.defer', 'value']) }}/>
    </div>
</label>