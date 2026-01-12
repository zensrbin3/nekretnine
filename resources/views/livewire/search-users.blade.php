<div class="position-relative w-50 mx-auto">
    <input
        type="text"
        class="form-control"
        placeholder="Pretraži nekretnine..."
        wire:model.live="search"
    >

    @if($search !== '' && $properties->count())
        <div class="list-group position-absolute w-100 mt-1 shadow">
            @foreach($properties as $property)
                <a href="#"
                   class="list-group-item list-group-item-action">
                    {{ $property->title }}
                </a>
            @endforeach
        </div>
    @endif
</div>
