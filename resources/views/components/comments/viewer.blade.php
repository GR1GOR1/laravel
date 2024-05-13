@props([
    'model'
])
<hr>
<div>Комментарии</div>
<hr>
<div>
    @foreach($model->comments as $comment)
        <div class="alert alert-success my-2">{{ $comment->text }}</div>
    @endforeach
</div>