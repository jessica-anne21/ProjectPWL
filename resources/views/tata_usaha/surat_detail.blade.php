@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Detail Surat Pengajuan</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <p><strong>Nama Mahasiswa:</strong> {{ $surat->mahasiswa->user->name ?? 'Tidak Diketahui' }}</p>
                <p><strong>NRP:</strong> {{ $surat->mahasiswa->nrp }}</p>
                <p><strong>Jenis Surat:</strong> {{ $surat->jenis_surat }}</p>
                <p><strong>Deskripsi:</strong> {{ $surat->deskripsi }}</p>
                <p><strong>Status:</strong> {{ $surat->status }}</p>
                <p><strong>Tanggal Pengajuan:</strong> {{ $surat->created_at->format('d M Y') }}</p>

                @if($surat->status === 'Disetujui' && !$surat->file_surat)
                <form action="{{ route('tata_usaha.surat_upload', $surat->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label for="file_surat" class="form-label">Unggah File PDF</label>
                        <input type="file" name="file_surat" id="file_surat" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success">Unggah Surat</button>
                </form>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
