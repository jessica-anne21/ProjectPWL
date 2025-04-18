<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Role ID untuk TU -->
        <input type="hidden" name="role_id" value="4">


        <div>
            <x-input-label for="id_tata_usaha" :value="__('ID Tata Usaha')" />
            <x-text-input id="id_tata_usaha" class="block mt-1 w-full" type="text" name="id_tata_usaha" :value="old('id_tata_usaha')" required autofocus />
            <x-input-error :messages="$errors->get('id_tata_usaha')" class="mt-2" />
        </div>

        <!-- Program Studi -->
        <div class="mt-4">
            <x-input-label for="program_studi_id" :value="__('Program Studi')" />
            <select id="program_studi_id" name="program_studi_id" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" required>
                <option value="" disabled {{ old('program_studi_id') == '' ? 'selected' : '' }}>Pilih Program Studi</option>
                <option value="1" {{ old('program_studi_id') == '1' ? 'selected' : '' }}>Teknik Informatika</option>
                <option value="2" {{ old('program_studi_id') == '2' ? 'selected' : '' }}>Sistem Informasi</option>
                <option value="3" {{ old('program_studi_id') == '3' ? 'selected' : '' }}>Magister Ilmu Komputer</option>
            </select>
            <x-input-error :messages="$errors->get('program_studi_id')" class="mt-2" />
        </div> 

        <!-- Name -->
        <div class="mt-4">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <!-- Email -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <!-- Tombol Register -->
        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Register as Tata Usaha') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
