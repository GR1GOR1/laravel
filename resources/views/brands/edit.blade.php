<x-layout.main title="Edit brand #{{ $brand->id }}">
    <x-form action="{{ route('brands.update', [ $brand->id ] ) }}" method="put">
        @bind($brand)
            @include("brands.form")
        @endbind
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.main>