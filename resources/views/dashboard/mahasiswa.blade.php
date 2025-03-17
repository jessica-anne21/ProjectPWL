<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-2xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Mahasiswa') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gradient-to-br from-blue-500 to-indigo-600 min-h-screen flex justify-center items-center">
        <div class="max-w-4xl mx-auto px-6">
            <div class="bg-white dark:bg-gray-900 shadow-xl rounded-2xl overflow-hidden">
                <div class="p-8 text-center">
                    <h3 class="text-3xl font-semibold text-gray-800 dark:text-gray-100">
                    {{ __("Welcome, " . Auth::user()->name . "!") }}                    </h3>
                    <p class="mt-4 text-gray-600 dark:text-gray-400">
                        Anda berhasil masuk ke dalam sistem. Gunakan fitur yang tersedia untuk mengelola pengajuan surat.
                    </p>
    
                </div>
                
            </div>
        </div>
    </div>
</x-app-layout>
