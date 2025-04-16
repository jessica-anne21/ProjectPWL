<?php namespace App\Http\Controllers;

use App\Models\PengajuanSurat;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KaprodiController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');  // Pastikan hanya yang login yang bisa mengakses
    }

    // Menampilkan pengajuan surat berdasarkan status
    public function showSurat(Request $request)
    {
        $kaprodi = Auth::user()->kaprodi;  // Ambil data Kaprodi dari user yang login
        $status = $request->status;  // Status yang diterima dari parameter URL

        // Ambil pengajuan surat berdasarkan status dan program studi Kaprodi
        $surat = PengajuanSurat::whereHas('mahasiswa', function ($query) use ($kaprodi) {
            $query->where('program_studi_id', $kaprodi->program_studi_id);
        })->where('status', $status)->orderBy('created_at', 'desc')->get();

        return view('kaprodi.surat', compact('surat', 'status'));
    }
}
