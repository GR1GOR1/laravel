<x-layout.main title="Trashed cars" h1="Cars">
    <hr>
    <a href="{{ route('cars.index') }}">Список всех машин</a>
    <hr>
    <div class="roe">
        @foreach($cars as $car)
            <div class="col m-3">
                <h3>{{ $car->model }} / {{ $car->brand }}</h3>
                <x-form method="put" :action="route('cars.restore', [ $car->id ])">
                    <button class="btn btn-success">Восстановить</button>
                </x-form>
                <!-- <a href="{{ route('cars.edit', [$car->id]) }}">Восстановить</a> -->
            </div>
        @endforeach
    </div>
</x-layout.main>