<x-layout.main title="Brands" h1="Брэнды">
    <hr>
    <a href="{{ route('brands.create') }}">Create Brand</a>
    <hr>
    @if($brands->isNotEmpty())
    <div class="row">
        @foreach($brands as $brand)
            <div class="col m-3">
                <h3>{{ $brand->title }}</h3>
                <a href="{{ route('brands.show', [$brand->id]) }}">Подробнее</a>
                <a href="{{ route('brands.edit', [$brand->id]) }}">Редактировать</a>
            </div>
        @endforeach
    </div>
    @else
        <div>Записей нет !</div>
    @endif
</x-layout.main>