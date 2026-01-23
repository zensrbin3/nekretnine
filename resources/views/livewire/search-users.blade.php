<div class="position-relative w-50 mx-auto">

    <input
        type="text"
        class="form-control form-control-lg"
        placeholder="Pretraži nekretnine..."
        wire:model.debounce.300ms="search"
    >

    @if($search !== '' && $properties->count())
        <div class="list-group position-absolute w-100 mt-2 shadow-sm"
             style="z-index: 1000">

            @foreach($properties as $property)
                <a href="{{ route('property.show', $property->id) }}"
                   class="list-group-item list-group-item-action d-flex justify-content-between align-items-center">

                    <span>{{ $property->title }}</span>

                    <span class="badge bg-secondary text-capitalize">
                        {{ $property->type }}
                    </span>
                </a>
            @endforeach

        </div>
    @endif

</div>
