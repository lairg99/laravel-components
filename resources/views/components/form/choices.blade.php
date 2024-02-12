@props([
    'dynamic' => false,
    'placeholder' => 'Auswählen...',
    'create' => null,
    'disabled' => false,
    'optional' => false,
    'label' => null,
    'highlight' => false,
])

@php

    $key = $attributes->only(['wire:model', 'wire:model.defer', 'wire:model.live'])->first() ?? \Illuminate\Support\Str::random();
    $error = \Illuminate\Support\Arr::first($errors->get($key) ?? []);

    /** @var \Illuminate\View\ComponentAttributeBag $attributes */
    $wireMethod = $attributes->get('wire:options');
    $wireProperty = $attributes->only(['wire:model', 'wire:model.defer', 'wire:model.live'])->first();

    if (! $wireMethod) {
        throw new InvalidArgumentException("You have to provide wire:options as ['key' => 'value', ...] to use choices.");
    }

@endphp

<div {{ $attributes->only('class') }}>
    @if($label)
        <x-veo::form.label :has-highlight="$highlight" :has-error="$error !== null" for="{{ $key }}" :$optional>{{ $label }}</x-veo::form.label>
    @endif

    <div class="flex items-center w-full">
        <div @class(['w-full', 'has-error' => $error, 'has-highlight' => $highlight])>
            <div wire:ignore>
                <div wire:ignore
                     x-data="{
                choices: null,

                dynamic: @js($dynamic),
                placeholder: @js($placeholder),
                search: null,
                debounce: null,
                initalOptions: [],

                value: @if($attributes->has('wire:model')) @entangle($attributes->only(['wire:model', 'wire:model.defer', 'wire:model.live'])->first()) @else null @endif,

                async init() {
                    this.choices = new Choices($refs.choice, {
                        searchResultLimit: 8,
                        noResultsText: 'Keine Ergebnisse',
                        noChoicesText: this.dynamic
                            ? 'Tippen, um zu Suchen ...'
                            : 'Keine Auswahlmöglichkeiten',
                        itemSelectText: 'auswählen',
                        searchPlaceholderValue: 'Tippen, um zu Suchen ...',
                        placeholderValue: 'test',
                        searchResultLimit: 10,
                        allowHTML: false,
                    })

                    @if(! $dynamic)
                        this.choices.setChoices(this.optionsToChoices(@js($this->$wireMethod())));

                        if (! this.value) {
                            this.refreshPlaceholder();
                        }
                    @else
                        if(this.value !== null) {
                            this.initalOptions = this.optionsToChoices(
                                @js($this->$wireMethod(null, $this->getPropertyValue($wireProperty)))
                            );
                        }

                        const options = await this.getOptions();

                        this.choices.setChoices(options);

                        if (options.length === 0 || ! this.value) {
                            this.refreshPlaceholder();
                        }
                    @endif

                    $watch('value', async(value) => {
                        $nextTick(async () => {
                        await this.refreshChoices();
                        await this.setUpInitalOption();
                        });
                    });

                    $wire.on('selectOptionsUpdated', async () => {
                        await this.setUpInitalOption();
                        await this.refreshChoices();
                    });

                    $refs.choice.addEventListener('change', async () => {
                        this.value = this.choices.getValue(true);
                        await this.setUpInitalOption();
                   });

                    if(this.dynamic) {
                      $refs.choice.addEventListener('search', event => {
                        clearTimeout(this.debounce);

                        this.showLoading();

                        this.debounce = setTimeout(() => {
                            this.search = event.detail.value;

                            this.refreshChoices();
                        }, 300);
                      });
                    }
                },

                async showLoading() {
                    this.choices.clearStore();
                    this.choices.setChoices([{ label: 'Laden...', value: '', disabled: true }]);

                    this.refreshPlaceholder();
                },

                async setUpInitalOption() {
                    this.initalOptions = this.optionsToChoices(
                        await $wire.{{ $wireMethod }}(null, this.value)
                    );
                },

                async refreshChoices() {
                    const options = await this.getOptions();

                    this.choices.clearStore();
                    this.choices.setChoices(options);
                },

                refreshPlaceholder() {
                    this.$el.querySelector('.choices__list--single')
                        .innerHTML = `<div class='choices__placeholder choices__item'>${this.placeholder}</div>`;
                },

                async getOptions() {
                    let options = [];

                    if (! this.dynamic) {
                        options = this.optionsToChoices(await $wire.{{ $wireMethod }}());
                    }

                    if (this.search) {
                        options = this.optionsToChoices(await $wire.{{ $wireMethod }}(this.search));
                    }

                    if (this.initalOptions) {
                        options = [... options, ...this.initalOptions];
                    }

                    return this.unique(options, 'value');
                },

                unique(array, property) {
                    return array.filter((v,i,a)=>a.findIndex(v2=>(v2[property]===v[property]))===i);
                },

                optionsToChoices(fromWire) {
                    return Object.entries(fromWire).map(([candidate, label]) => {
                        return { value: candidate, label, selected: candidate == this.value }
                    });
                }
            }">
                    <select x-ref="choice"></select>
                </div>
            </div>
        </div>

        @if($create)
            <x-veo::icon-button class="ml-3" icon="plus" color="tertiary" :wire:click="$create"/>
        @endif
    </div>
</div>

