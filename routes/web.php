<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\Mahasiswa;
use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Http\Request;
use App\Http\Controllers\SuratController;

use App\Http\Controllers\MahasiswaController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;



Route::get('/admin/users', [AdminController::class, 'index'])->name('admin.users.index');
Route::get('/admin/users/create', [AdminController::class, 'create'])->name('admin.users.create');
Route::post('/admin/users', [AdminController::class, 'store'])->name('admin.users.store');
Route::get('/admin/users/{user}/edit', [AdminController::class, 'edit'])->name('admin.users.edit');
Route::put('/admin/users/{user}', [AdminController::class, 'update'])->name('admin.users.update');
Route::delete('/admin/users/{user}', [AdminController::class, 'destroy'])->name('admin.users.destroy');



// Route::middleware(['auth', 'admin'])->prefix('admin')->group(function () {
//     Route::get('/users', [AdminController::class, 'index'])->name('admin.users.index');
//     Route::get('/users/create', [AdminController::class, 'create'])->name('admin.users.create');
//     Route::post('/users', [AdminController::class, 'store'])->name('admin.users.store');
// });




Route::middleware('auth')->post('/logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/');
})->name('logout');



Route::get('/dashboard/mahasiswa', [MahasiswaController::class, 'dashboard'])->name('mahasiswa.dashboard');

// Route::get('/mahasiswa/surat', [SuratController::class, 'create'])->name('mahasiswa.upload-surat');
// Route::post('/mahasiswa/surat', [SuratController::class, 'store'])->name('mahasiswa.surat.store');



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
    Route::get('/dashboard/mahasiswa', [DashboardController::class, 'mahasiswa'])->name('mahasiswa.dashboard');
    Route::get('/dashboard/ketua-prodi', [DashboardController::class, 'ketuaProdi'])->name('kaprodi.dashboard');
    Route::get('/dashboard/tata-usaha', [DashboardController::class, 'tataUsaha'])->name('tata_usaha.dashboard');
    Route::get('/dashboard/admin', [DashboardController::class, 'admin'])->name('admin.dashboard');
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


use App\Http\Controllers\NotificationController;


Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
Route::post('/notifications/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.markAsRead');

Route::get('/mahasiswa/surat', [SuratController::class, 'index'])->name('mahasiswa.surat');
Route::post('/mahasiswa/surat', [SuratController::class, 'store'])->name('mahasiswa.surat.store');
Route::get('/mahasiswa/surat/{id}/edit', [SuratController::class, 'edit'])->name('mahasiswa.surat.edit');
Route::put('/mahasiswa/surat/{id}', [SuratController::class, 'update'])->name('mahasiswa.surat.update');
Route::delete('/mahasiswa/surat/{id}', [SuratController::class, 'destroy'])->name('mahasiswa.surat.destroy');


Route::get('/kaprodi/surat', [SuratController::class, 'listByStatus'])->name('kaprodi.surat');
Route::get('/kaprodi/surat/{id}', [SuratController::class, 'show'])->name('surat.detail');
Route::post('/kaprodi/surat/{id}/approve', [SuratController::class, 'approve'])->name('kaprodi.surat.approve');


Route::get('/dashboard/tata-usaha', [SuratController::class, 'dashboardTU'])->name('tata_usaha.dashboard');
Route::get('/tatausaha/surat/{id}', [SuratController::class, 'detail'])->name('tata_usaha.surat_detail');
Route::post('/tatausaha/surat/{id}/upload', [SuratController::class, 'uploadSurat'])->name('tata_usaha.surat_upload');


    // Route::middleware(['role:kaprodi'])->group(function () {
    //     Route::post('/kaprodi/surat/{id}/approve', [SuratController::class, 'approve'])->name('surat.approve');
    // });

    // Route::middleware(['role:tata_usaha'])->group(function () {
    //     Route::post('/tu/surat/{id}/upload', [SuratController::class, 'uploadSurat'])->name('surat.upload');
    // });

    // Route::get('/mahasiswa/surat/{id}/download', [SuratController::class, 'downloadSurat'])->name('surat.download');


require __DIR__.'/auth.php';
