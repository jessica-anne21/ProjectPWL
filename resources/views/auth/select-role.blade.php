<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-10 p-6 bg-white shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6">Pilih Peran</h2>

        <form method="POST" action="{{ route('login.redirect') }}">
            @csrf
            <div>
                <x-input-label for="role" :value="__('Login sebagai')" />
                <select id="role" name="role" required class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm">
                    <option value="mahasiswa">Mahasiswa</option>
                    <option value="kaprodi">Ketua Prodi</option>
                    <option value="tata_usaha">Tata Usaha</option>
                </select>
            </div>

            <div class="flex items-center justify-center mt-6">
                <x-primary-button>
                    {{ __('Lanjutkan') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
