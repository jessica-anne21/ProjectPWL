<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
        @csrf

        <input type="hidden" name="role" value="Admin">


        <!-- Id TU -->
        <div>
            <x-input-label for="id_admin" :value="__('Id Admin')" />
            <x-text-input id="id_admin" class="block mt-1 w-full" type="text" name="id_admin" :value="old('id_admin')" required autofocus />
            <x-input-error :messages="$errors->get('id_admin')" class="mt-2" />
        </div>

        <!-- Program Studi -->
        <div class="mt-4">
            <x-input-label for="program_studi" :value="__('Program Studi')" />
            <select id="program_studi" name="program_studi" class="block mt-1 w-full border-gray-300 dark:border-gray-700 rounded-lg shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800">
                <option value="" disabled selected>Pilih Program Studi</option>
                <option value="Teknik Informatika">Teknik Informatika</option>
                <option value="Sistem Informasi">Sistem Informasi</option>
                <option value="Magister Ilmu Komputer">Magister Ilmu Komputer</option>
            </select>
            <x-input-error :messages="$errors->get('program_studi')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Register as Admin') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
