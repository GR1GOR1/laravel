<x-layout.main title="Edit">
    <h2>Edit post № {{ $post->id }}</h2>
    <form method="post" action="{{ route('posts.update', [$post->id]) }}">
        @method('PUT')
        @csrf
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->

        <!-- <div>Content: <textarea name="content">{{ $post->content }}</textarea> -->
        <x-input label="Post title" name="title" default-value="{{ $post->title }}" />
        <x-input label="Post content" name="content" default-value="{{ $post->content }}" />
        <hr>
        <button>Send</button>
    </form>
</x-layout.main>