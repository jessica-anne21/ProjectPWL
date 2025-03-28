@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Pengajuan Surat</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama Mahasiswa:</strong> {{ $pengajuan->mahasiswa->user->name ?? '-' }}</p>
                <p><strong>NRP:</strong> {{ $pengajuan->mahasiswa->nrp ?? '-' }}</p>
                <p><strong>Jenis Surat:</strong> {{ $pengajuan->jenis_surat ?? '-' }}</p>
                <p><strong>Deskripsi:</strong> {{ $pengajuan->deskripsi ?? 'Tidak ada deskripsi' }}</p>
                <p><strong>Status:</strong> 
                    <span class="badge 
                        {{ $pengajuan->status == 'Menunggu Persetujuan' ? 'bg-warning' : 
                           ($pengajuan->status == 'Disetujui' ? 'bg-success' : 'bg-danger') }}">
                        {{ $pengajuan->status }}
                    </span>
                </p>
                <p><strong>Tanggal Pengajuan:</strong> {{ $pengajuan->created_at->format('d M Y') }}</p>

                @if ($pengajuan->status === 'Menunggu Persetujuan')
                <form action="{{ route('kaprodi.surat.approve', $pengajuan->id) }}" method="POST">
    @csrf
    <div class="d-flex">
        <button type="submit" name="status" value="Disetujui" class="btn btn-success me-2">Setujui</button>
        <button type="submit" name="status" value="Ditolak" class="btn btn-danger">Tolak</button>
    </div>
</form>

                @endif
            </div>
        </div>
    </div>
</div>
@endsection
