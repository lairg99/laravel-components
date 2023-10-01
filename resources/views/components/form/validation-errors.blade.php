@props(['errors'])

@if($errors->any())
    <x-veo::feedback type="danger" class="mt-0 mb-6">
        <div class="font-bold text">
            Ups, etwas ist schief gelaufen.
        </div>

        {{ $errors->first() }}
    </x-veo::feedback>
@endif
