<x-guest-layout>
    <div class="w-full max-w-md mx-auto mt-10 p-6 bg-white dark:bg-gray-900 shadow-md rounded-lg">
        <h2 class="text-2xl font-semibold text-center mb-6 text-gray-800 dark:text-white">Pilih Peran</h2>

        <div class="grid grid-cols-1 gap-4">
            <!-- Register sebagai Mahasiswa -->
            <a href="{{ route('register.mahasiswa') }}" class="flex items-center p-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-indigo-600 dark:text-indigo-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 14l9-5-9-5-9 5 9 5zM12 14v7m4-3H8"/>
                </svg>
                <span class="ml-3 text-gray-800 dark:text-white text-lg font-medium">Mahasiswa</span>
            </a>

            <!-- Register sebagai Kaprodi -->
            <a href="{{ route('register.kaprodi') }}" class="flex items-center p-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-green-600 dark:text-green-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7V3H8v4M4 8h16v12H4V8z"/>
                </svg>
                <span class="ml-3 text-gray-800 dark:text-white text-lg font-medium">Ketua Prodi</span>
            </a>

            <!-- Register sebagai Tata Usaha -->
            <a href="{{ route('register.tu') }}" class="flex items-center p-4 border border-gray-300 dark:border-gray-700 rounded-lg shadow-sm hover:bg-gray-100 dark:hover:bg-gray-800 transition duration-300">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-blue-600 dark:text-blue-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m5-10H5a2 2 0 00-2 2v14a2 2 0 002 2h14a2 2 0 002-2V5a2 2 0 00-2-2z"/>
                </svg>
                <span class="ml-3 text-gray-800 dark:text-white text-lg font-medium">Tata Usaha</span>
            </a>
        </div>
    </div>
</x-guest-layout>
