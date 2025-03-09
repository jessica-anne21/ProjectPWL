<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Portal Pengajuan Surat</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gradient-to-r from-blue-900 to-blue-800 flex items-center justify-center h-screen">
    <div class="text-center bg-white p-10 rounded-lg shadow-2xl max-w-md transform transition duration-500 hover:scale-105">
        <h1 class="text-4xl font-extrabold text-gray-800 mb-4">Selamat Datang!</h1>
        <p class="text-gray-600 mb-6 text-lg">Nikmati kemudahan akses dalam pengajuan surat. Silakan masuk atau daftar untuk melanjutkan.</p>
        <div class="flex justify-center space-x-4">
            <a href="{{ route('login') }}" class="bg-blue-500 text-white px-6 py-3 rounded-lg shadow-md text-lg font-semibold hover:bg-blue-700 transition">Login</a>
            <a href="{{ route('register') }}" class="bg-green-500 text-white px-6 py-3 rounded-lg shadow-md text-lg font-semibold hover:bg-green-700 transition">Register</a>
        </div>
    </div>
</body>
</html>
