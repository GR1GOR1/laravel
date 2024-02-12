<x-layout.main title="Laravel posts" h1="mainpage">
    <h2>{{ $some }}</h2>
    <hr>
    <a href="/posts/create">Create post</a>
    <hr>
    <ul>
        @foreach($posts as $post)
            <li>
                {{ $post->title }}
                <a href="{{ route('posts.show', [$post->id]) }}">Read More</a>
                <a href="/posts/{{ $post->id }}/edit">Edit</a>
            </li>
        @endforeach
    </ul>
</x-layout.main>