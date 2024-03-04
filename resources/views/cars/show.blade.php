<x-layout.main title="Edit car #{{ $car->id }}">
    <div>{{ $car->model }}</div>
    <div>{{ $car->brand }}</div>
    <div>{{ $car->transmission }}</div>
    <div>{{ $car->created_at }}</div>
    <div>{{ $car->vin }}</div>
    <x-form method="delete" action="{{ route('cars.destroy', [ $car->id ]) }}">
        <button class="btn btn-danger">Удалить</button>
    </x-form>
</x-layout.main>