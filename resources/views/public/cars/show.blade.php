<x-layout.guest title="Car #{{ $car->id }}">
<a href="{{ route('home') }}" >Машинки</a>
<hr>
    <div><span class="fs-2">Модель:</span> {{ $car->model }}</div>
    <div><span class="fs-2">Брэнд:</span> {{ $car->brand->title }}</div>
    <div><span class="fs-2">Трансмиссия:</span> {{ $car->transmission }}</div>
    <div>{{ $car->created_at }}</div>
    <div><span class="fs-2">ВИН:</span> {{ $car->vin }}</div>
    <x-comments.create :id="$car->id" model="car" />
    <x-comments.viewer :model="$car" />
</x-layout.guest>