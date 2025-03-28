<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pengajuan Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white flex items-center justify-center h-screen relative overflow-hidden">

    <!-- Elemen Dekoratif -->
    <div class="absolute top-10 left-10 w-24 h-24 bg-orange-100 rounded-full opacity-50"></div>
    <div class="absolute top-1/2 left-1/3 w-28 h-28 border-4 border-orange-300 rounded-full opacity-40"></div>
    <div class="absolute bottom-40 right-60 w-36 h-36 bg-orange-200 rounded-full opacity-50"></div>
    <div class="absolute bottom-10 right-20 w-16 h-16 bg-orange-200 rounded-full opacity-50"></div>

    <!-- Tambahan Lingkaran Abstrak -->
    <div class="absolute top-1/4 right-1/3 w-20 h-20 border-2 border-orange-300 rounded-full opacity-30"></div>
    <div class="absolute top-1/3 left-20 w-28 h-28 bg-orange-100 rounded-full opacity-40"></div>
    <div class="absolute bottom-10 left-40 w-32 h-32 border-4 border-orange-300 rounded-full opacity-30"></div>
    <div class="absolute bottom-24 right-1/2 w-16 h-16 bg-orange-200 rounded-full opacity-50"></div>

    <!-- Icon Surat -->
    <div class="absolute top-1/3 left-1/4 text-orange-500 text-6xl opacity-30 mix-blend-multiply">📜</div>

    <!-- Container Utama -->
    <div class="container mx-auto px-6 flex flex-col-reverse md:flex-row items-center relative">

        <!-- Bagian Kiri (Teks dan Tombol) -->
        <div class="md:w-1/2 text-gray-800 z-10">
            <h1 class="text-5xl font-extrabold mb-4 text-gray-900 leading-tight">
                Selamat Datang!
                <span class="block w-40 h-1 bg-orange-500 mt-2"></span>
            </h1>
            <p class="text-lg text-gray-600 mb-6">
                Nikmati kemudahan akses dalam pengajuan surat. Silakan masuk untuk melanjutkan.
            </p>
            <a href="{{ route('login') }}" class="bg-orange-500 text-white px-6 py-3 rounded-lg shadow-lg text-lg font-semibold 
                hover:bg-orange-600 transition">
                Login
            </a>
        </div>

        <!-- Bagian Kanan (Gambar) -->
        <div class="md:w-1/2 flex justify-center relative">
            <img src="{{ asset('images/education.jpg') }}" alt="Ilustrasi Pendidikan" class="w-[400px]">
        </div>

    </div>

</body>
</html>
