<x-guest-layout>
    <h2 class="text-xl font-semibold text-center mb-6">Login Ketua Prodi</h2>
    @include('auth.partials.login-form', ['role' => 'kaprodi'])
</x-guest-layout>
