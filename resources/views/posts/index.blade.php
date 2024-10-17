<x-layout.main title="Laravel posts" h1="mainpage">
    <h2>{{ $some }}</h2>
    <hr>
    <a href="{{ route('posts.create') }}">Create post</a>
    <hr>
    <ul>
        @foreach($posts as $post)
            <li>
                {{ $post->title }}
                <a href="{{ route('posts.show', [$post->id]) }}">Read More</a>
                @can('update', $post)
                    <a href="{{ route('posts.edit', [$post->id]) }}">Edit</a>
                @endif
            </li>
        @endforeach
    </ul>
</x-layout.main>