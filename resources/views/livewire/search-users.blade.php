<div class="w-50 mx-auto position-relative">
    <div class="d-flex gap-2">
        <select
            class="form-select w-25"
            wire:model.live="type"
        >
            <option value="">Kategorija:</option>
            <option value="all">Sve</option>
            <option value="apartment">Apartman</option>
            <option value="land">Zemlja</option>
            <option value="office">Kancelarija</option>
            <option value="house">Kuća</option>
        </select>

        <input
            type="text"
            class="form-control"
            placeholder="Pretraži nekretnine..."
            wire:model.live="search"
        >
    </div>

    @if(($search !== '' || $type !== '') && $properties->count())
        <div class="list-group position-absolute w-100 mt-1 shadow" style="z-index:1000">
            @foreach($properties as $property)
                <a href="{{ route('property.show', $property->id) }}"
                   class="list-group-item list-group-item-action">
                    {{ $property->title }}
                </a>
            @endforeach
        </div>
    @endif
</div>
