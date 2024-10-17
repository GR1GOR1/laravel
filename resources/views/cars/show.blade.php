<x-layout.main title="Car #{{ $car->id }}">
    <div><span class="fs-2">Модель:</span> {{ $car->model }}</div>
    <div><span class="fs-2">Брэнд:</span> {{ $car->brand->title }}</div>
    <div><span class="fs-2">Трансмиссия:</span> {{ $car->transmission }}</div>
    <div>{{ $car->created_at }}</div>
    <div><span class="fs-2">ВИН:</span> {{ $car->vin }}</div>
    <!-- <div><span class="fs-2">Теги:</span></div>
    <div>{{ $car->tags }}</div> -->
    {{ $car->status->text() }}
    @if ($car->canDelete)
    <x-form method="delete" action="{{ route('cars.destroy', [ $car->id ]) }}">
        <button class="btn btn-danger">Удалить</button>
    </x-form>
    @endif
</x-layout.main>