<x-guest-layout>
    <h2 class="text-xl font-semibold text-center mb-6">Login Admin</h2>
    @include('auth.partials.login-form', ['role' => 'admin'])
</x-guest-layout>
