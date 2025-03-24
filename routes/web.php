<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\Mahasiswa;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use App\Http\Controllers\SuratController;

use App\Http\Controllers\MahasiswaController;

// use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

Route::post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');


Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'dashboard'])->name('dashboard.mahasiswa');


Route::post('/surat', [SuratController::class, 'store'])->name('surat.store');


Route::get('/login', function () {
    return view('select-role'); // Menampilkan halaman pemilihan peran
})->name('login');

Route::post('/login-redirect', function (Request $request) {
    $role = $request->input('role');

    if ($role === 'mahasiswa') {
        return redirect()->route('login.mahasiswa');
    } elseif ($role === 'kaprodi') {
        return redirect()->route('login.kaprodi');
    } elseif ($role === 'tata_usaha') {
        return redirect()->route('login.tata_usaha');
    } elseif ($role === 'admin') {
        return redirect()->route('login.admin');
    }

    return back()->withErrors(['role' => 'Peran tidak valid.']);
})->name('login.redirect');

Route::get('/login-mahasiswa', function () {
    return view('auth.login-mahasiswa');
})->name('login.mahasiswa');

Route::get('/login-kaprodi', function () {
    return view('auth.login-kaprodi');
})->name('login.kaprodi');

Route::get('/login-tata-usaha', function () {
    return view('auth.login-tata-usaha');
})->name('login.tata_usaha');

Route::get('/login-admin', function () {
    return view('auth.login-admin');
})->name('login.admin');


Route::get('/register', function () {
    return view('auth.register');
})->name('register');

Route::get('/register/mahasiswa', [RegisteredUserController::class, 'showMahasiswaRegister'])->name('register.mahasiswa');
Route::get('/register/kaprodi', [RegisteredUserController::class, 'showKaprodiRegister'])->name('register.kaprodi');
Route::get('/register/tu', [RegisteredUserController::class, 'showTURegister'])->name('register.tu');
Route::get('/register/admin', [RegisteredUserController::class, 'showAdminRegister'])->name('register.admin');



// Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');


Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('dashboard.mahasiswa');
    Route::get('/dashboard/ketua-prodi', [DashboardController::class, 'ketuaProdi'])->name('dashboard.ketua_prodi');
    Route::get('/dashboard/tata-usaha', [DashboardController::class, 'tataUsaha'])->name('dashboard.tata_usaha');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('dashboard.admin');
});


Route::get('/', function () {
    return view('welcome');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
