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
            return redirect()->route('mahasiswa.dashboard');
        } elseif ($user->role_id == 3) {
            return redirect()->route('kaprodi.dashboard');
        } elseif ($user->role_id == 4) {
            return redirect()->route('tata_usaha.dashboard');
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

    return view('mahasiswa.dashboard', compact('riwayat_surat'));
    }

    public function ketuaProdi()
{
    // Ambil data kaprodi dari user yang login
    $kaprodi = Auth::user()->kaprodi;

    // Debugging untuk cek apakah kaprodi null
    if (!$kaprodi) {
        dd("ERROR: Data Ketua Prodi tidak ditemukan!", Auth::user());
    }

    // Debugging untuk cek apakah program_studi_id null
    if (is_null($kaprodi->program_studi_id)) {
        dd("ERROR: program_studi_id Ketua Prodi NULL!", $kaprodi);
    }

    // Ambil jumlah surat berdasarkan program studi dari mahasiswa
    $jumlah_menunggu = PengajuanSurat::whereHas('mahasiswa', function ($query) use ($kaprodi) {
        $query->where('program_studi_id', $kaprodi->program_studi_id);
    })->where('status', 'Menunggu Persetujuan')->count();

    $jumlah_disetujui = PengajuanSurat::whereHas('mahasiswa', function ($query) use ($kaprodi) {
        $query->where('program_studi_id', $kaprodi->program_studi_id);
    })->where('status', 'Disetujui')->count();

    $jumlah_ditolak = PengajuanSurat::whereHas('mahasiswa', function ($query) use ($kaprodi) {
        $query->where('program_studi_id', $kaprodi->program_studi_id);
    })->where('status', 'Ditolak')->count();

    

    return view('kaprodi.dashboard', compact('jumlah_menunggu', 'jumlah_disetujui', 'jumlah_ditolak'));
}


    public function tataUsaha()
    {
        return view('tata_usaha.dashboard');
    }

    public function admin()
    {
        $total_users = User::count(); // Menghitung jumlah user di database

    return view('admin.dashboard', compact('total_users'));
    }
}
