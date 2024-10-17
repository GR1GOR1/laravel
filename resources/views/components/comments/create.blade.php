@props([
    'id',
    'model'
])

<x-form action="{{ route('comments.store') }}">
    <input type="hidden" name="id" value="{{ $id }}">
    <input type="hidden" name="model" value="{{ $model }}">
    <x-form-textarea name="text" label="Текст комментария" />
    <div class="mb-3 mt-3">
        <button class="btn btn-success">Сохранить</button>
     </div>
</x-form>