<x-layout.main title="Car #{{ $car->id }}">
    <div>{{ $car->model }}</div>
    <div>{{ $car->brand->title }}</div>
    <div>{{ $car->transmission }}</div>
    <div>{{ $car->created_at }}</div>
    <div>{{ $car->vin }}</div>
    <!-- <div>{{ $car->tags }}</div> -->
    <x-form method="delete" action="{{ route('cars.destroy', [ $car->id ]) }}">
        <button class="btn btn-danger">Удалить</button>
    </x-form>
</x-layout.main>