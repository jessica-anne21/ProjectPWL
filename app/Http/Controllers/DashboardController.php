<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PengajuanSurat;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect sesuai peran
        if ($user->role_id == 1) {
            return redirect()->route('admin.dashboard');
        } elseif ($user->role_id == 2) {
            return redirect()->route('dashboard.mahasiswa');
        } elseif ($user->role_id == 3) {
            return redirect()->route('dashboard.ketua_prodi');
        } elseif ($user->role_id == 4) {
            return redirect()->route('dashboard.tata_usaha');
        }
        

        return abort(403, 'Unauthorized');
    }

    public function mahasiswa()
    {
        $user = Auth::user();

    // Ambil riwayat surat berdasarkan NRP mahasiswa
    $riwayat_surat = \App\Models\PengajuanSurat::where('nrp', $user->mahasiswa->nrp)
        ->orderBy('created_at', 'desc')
        ->get();

    return view('dashboard.mahasiswa', compact('riwayat_surat'));
    }

    public function ketuaProdi()
    {
        return view('dashboard.ketua_prodi');
    }

    public function tataUsaha()
    {
        return view('dashboard.tata_usaha');
    }

    public function admin()
    {
        $total_users = User::count(); // Menghitung jumlah user di database

    return view('admin.dashboard', compact('total_users'));
    }
}
