<x-layout.main title="Post {{ $post->title }}" h1="{{ $post->title }}">
    <div>
        {{ $post->content }}
    </div>
</x-layout.main>