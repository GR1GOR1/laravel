<x-layout.main title="Cars catalog" h1="Cars">
    <hr>
    <a href="/cars/create">Create car</a>
    <hr>
    <div class="roe">
        @foreach($cars as $car)
            <div class="col m-3">
                <h3>{{ $car->model }} / {{ $car->brand }}</h3>
                <a href="{{ route('cars.show', [$car->id]) }}">Подробнее</a>
                <a href="{{ route('cars.edit', [$car->id]) }}">Редактировать</a>
            </div>
        @endforeach
    </div>
</x-layout.main>