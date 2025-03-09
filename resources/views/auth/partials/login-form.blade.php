<form method="POST" action="{{ route('login') }}">
    @csrf

    <input type="hidden" name="role" value="{{ $role }}">

    <div>
        <x-input-label for="email" :value="__('Email')" />
        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" required autofocus autocomplete="username" />
    </div>

    <div class="mt-4">
        <x-input-label for="password" :value="__('Password')" />
        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
    </div>

    <div class="flex items-center justify-end mt-4">
        <x-primary-button>
            {{ __('Log in') }}
        </x-primary-button>
    </div>
</form>
