<x-layout.main title="Create car">
    <x-form action="{{ route('cars.store') }}">
        @include("cars.form")
        <div class="mb-3">
            <button class="btn btn-success">Сохранить</button>
        </div>
    </x-form>
</x-layout.main>