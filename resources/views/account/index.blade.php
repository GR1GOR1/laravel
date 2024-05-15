<x-layout.main title="Account">
    <x-form method="delete" action="{{ route('auth.sessions.destroy') }}">
        <button class="btn btn-danger">Exit</button>
    </x-form>
</x-layout.main>