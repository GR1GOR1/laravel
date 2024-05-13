<x-layout.guest title="Vhod na sait =)">
    <x-form action="{{ route('auth.sessions.store') }}">
    <div class="mb-3">
        <x-form-input name="email" type="email" label="Email" />
    </div>
    <div class="mb-3">
        <x-form-input name="password" type="password" label="Password" />
    </div>
    <div class="mb-3">
        <x-form-checkbox name="remember" label="Remember"/>
    </div>
        <div class="mb-3">
            <button class="btn btn-success">Войти</button>
        </div>
    </x-form>
</x-layout.guest>