<x-layout.guest title="Cars catalog" h1="Cars">
    <hr>
    <div class="roe">
        @foreach($cars as $car)
            <div class="col m-3">
                <em>{{ $car->brand->country->title }} {{ $car->status->text() }}</em>
                <h3>{{ $car->model }} / {{ $car->brand->title }} / {{ $car->vin }}</h3>
                <a href="{{ route('cars.show', [$car->id]) }}">Подробнее</a>
                @can('cars')
                <a href="{{ route('cars.edit', [$car->id]) }}">Редактировать</a>
                @endif
            </div>
        @endforeach
    </div>
</x-layout.guest>