<x-layout.main title="Create post">
    <h2>Create post</h2>
    <form method="post" action="/posts">
        @csrf
        <!-- <input type="hidden" name="_token" value="{{ csrf_token() }}" /> -->
        <x-input label="Post title" name="title" />
        <x-input label="Post content" name="content" />
        <hr>
        <button>Send</button>
    </form>
</x-layout.main>