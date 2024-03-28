<x-layout.main title="Edit brand #{{ $brand->id }}">
    <div>{{ $brand->id }}</div>
    <div>{{ $brand->title }}</div>
    <ul>
        @foreach($brand->cars as $car)
        <li>{{ $car->vin }}</li>
        @endforeach
    </ul>
    <x-form method="delete" action="{{ route('brands.destroy', [ $brand->id ]) }}">
        <button class="btn btn-danger">Удалить</button>
    </x-form>
</x-layout.main>