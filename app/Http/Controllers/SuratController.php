<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PengajuanSurat;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification; // di bagian atas file


class SuratController extends Controller
{
    // Menampilkan daftar pengajuan mahasiswa yang sedang login
    public function index()
{
    $user = Auth::user();

    // Ambil data mahasiswa dari user yang login
    $mahasiswa = $user->mahasiswa;

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    // Ambil pengajuan berdasarkan NRP mahasiswa
    $pengajuan = PengajuanSurat::where('nrp', $mahasiswa->nrp)->get();

    return view('mahasiswa.surat', compact('pengajuan'));
}

public function store(Request $request)
{
    $request->validate([
        'jenis_surat' => 'required|in:Surat Keterangan Mahasiswa Aktif, Surat Pengantar Tugas Mata Kuliah,Surat Keterangan Lulus, Laporan Hasil Studi',
        'deskripsi' => 'required|string',
    ]);

    $user = Auth::user();
    $mahasiswa = $user->mahasiswa;

    if (!$mahasiswa) {
        return redirect()->back()->with('error', 'Data mahasiswa tidak ditemukan.');
    }

    // Ambil NRP dari tabel mahasiswa
    $nrp = $mahasiswa->nrp;

    PengajuanSurat::create([
        'nrp' => $nrp,
        'jenis_surat' => $request->jenis_surat,
        'deskripsi' => $request->deskripsi,
        'status' => 'Menunggu Persetujuan',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    Notification::create([
        'role' => 'kaprodi',
        'nrp' => $mahasiswa->nrp,
        'message' => 'Pengajuan surat baru oleh ' . $mahasiswa->user->name,
        'is_read' => false,
        'created_at' => now(),
        'updated_at' => now(),
    ]);


    return redirect()->route('mahasiswa.surat')->with('success', 'Pengajuan surat berhasil dikirim.');
}





    // Kaprodi menyetujui atau menolak pengajuan
    public function approve(Request $request, $id)
{
    $request->validate([
        'status' => 'required|in:Disetujui,Ditolak',
    ]);

    $pengajuan = PengajuanSurat::findOrFail($id);
    $pengajuan->status = $request->status;
    $pengajuan->save();

    if ($request->status == 'Disetujui') {
        Notification::create([
            'role' => 'tu',
            'nrp' => $pengajuan->nrp,
            'message' => 'Surat telah disetujui oleh Kaprodi. Harap unggah suratnya.',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
    

    return redirect()->back()->with('success', 'Status pengajuan diperbarui!');
}


    public function listByStatus(Request $request)
{
    $status = $request->query('status'); // Ambil status dari URL
    $user = Auth::user();

    // Pastikan user adalah kaprodi dan ambil program studinya
    if (!$user || !$user->kaprodi) {
        return redirect()->back()->with('error', 'Anda bukan Ketua Program Studi!');
    }

    $program_studi_id = $user->kaprodi->program_studi_id;

    // Ambil pengajuan surat berdasarkan status dan program studi
    $pengajuan = PengajuanSurat::where('status', $status)
        ->whereHas('mahasiswa', function ($query) use ($program_studi_id) {
            $query->where('program_studi_id', $program_studi_id);
        })
        ->get();

    return view('kaprodi.surat', compact('pengajuan', 'status'));
}
public function show($id)
{
    $pengajuan = PengajuanSurat::findOrFail($id);

    return view('kaprodi.surat_detail', compact('pengajuan'));
}


    // Tata Usaha mengunggah file surat setelah disetujui
    public function uploadSurat(Request $request, $id)
    {
        $request->validate([
            'file_surat' => 'required|mimes:pdf|max:2048',
        ]);

        $pengajuan = PengajuanSurat::findOrFail($id);

        if ($pengajuan->status !== 'Disetujui') {
            return redirect()->back()->with('error', 'Pengajuan belum disetujui!');
        }

        $fileName = 'surat_' . $pengajuan->nrp . '_' . time() . '.' . $request->file_surat->extension();
        $request->file_surat->move(public_path('uploads/surat'), $fileName);

        $pengajuan->file_surat = $fileName;
        $pengajuan->save();
        Notification::create([
            'role' => 'mahasiswa',
            'nrp' => $pengajuan->nrp,
            'message' => 'Surat Anda telah tersedia dan bisa diunduh.',
            'is_read' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        

        return redirect()->back()->with('success', 'Surat berhasil diunggah!');
    }

    public function dashboardTU()
{
    $tataUsaha = Auth::user();

    if (!$tataUsaha || !$tataUsaha->tatausaha) {
        return redirect()->back()->with('error', 'Data Tata Usaha tidak ditemukan.');
    }

    $programStudiId = $tataUsaha->tatausaha->program_studi_id;

    // Ambil surat yang disetujui oleh Kaprodi, sesuai program studi TU, dan belum ada file
    $pengajuan = PengajuanSurat::whereHas('mahasiswa', function ($query) use ($programStudiId) {
        $query->where('program_studi_id', $programStudiId);
    })
    ->where('status', 'Disetujui')
    ->whereNull('file_surat')
    ->with('mahasiswa.user') // Pastikan relasi di-load
    ->get();

    return view('tata_usaha.dashboard', compact('pengajuan'));
}

public function detail($id)
{
    $surat = PengajuanSurat::with('mahasiswa.user')->findOrFail($id);
    
    return view('tata_usaha.surat_detail', compact('surat'));
}

    // Mahasiswa mengunduh surat
    public function downloadSurat($id)
    {
        $pengajuan = PengajuanSurat::findOrFail($id);

        if (!$pengajuan->file_surat) {
            return redirect()->back()->with('error', 'Surat belum tersedia!');
        }

        $filePath = public_path('uploads/surat/' . $pengajuan->file_surat);
        return response()->download($filePath);
    }

    public function edit($id)
{
    \Log::info("Editing surat with ID: $id");

    $surat = PengajuanSurat::where('id', $id)
        ->where('nrp', Auth::user()->nrp)
        ->firstOrFail();

    return view('mahasiswa.edit-surat', compact('surat'));
}

    


public function update(Request $request, $id)
{
    $request->validate([
        'jenis_surat' => 'required|string|max:255',
        'deskripsi' => 'nullable|string|max:1000',
    ]);

    // Ambil data pengajuan surat berdasarkan id dan nrp mahasiswa yang sedang login
    $surat = PengajuanSurat::where('id', $id)
        ->where('nrp', Auth::user()->nrp) // Sesuaikan dengan 'nrp'
        ->firstOrFail();

    // Cek status surat
    if ($surat->status !== 'Menunggu Persetujuan') {
        return redirect()->back()->with('error', 'Surat tidak dapat diedit karena sudah diproses.');
    }

    // Update surat dengan data baru
    $surat->update([
        'jenis_surat' => $request->jenis_surat,
        'deskripsi' => $request->deskripsi,
    ]);

    // Redirect ke halaman dashboard mahasiswa
    return redirect()->route('mahasiswa.dashboard')->with('success', 'Pengajuan surat berhasil diperbarui.');
}



public function destroy($id)
{
    // Mengambil data pengajuan surat berdasarkan id dan nrp mahasiswa yang sedang login
    $surat = PengajuanSurat::where('id', $id)
        ->where('nrp', Auth::user()->nrp) // Memastikan hanya mahasiswa yang bersangkutan yang bisa menghapus
        ->firstOrFail();

    // Cek apakah status surat sudah diproses, jika ya tidak bisa dihapus
    if ($surat->status !== 'Menunggu Persetujuan') {
        return redirect()->back()->with('error', 'Surat tidak dapat dihapus karena sudah diproses.');
    }

    // Hapus surat
    $surat->delete();

    return redirect()->route('mahasiswa.surat')->with('success', 'Pengajuan surat berhasil dihapus.');
}
}