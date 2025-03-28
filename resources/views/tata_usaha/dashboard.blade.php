@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
        </div>

        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Daftar Surat Disetujui (Menunggu File)</h5>
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nama Mahasiswa</th>
                            <th>NRP</th>
                            <th>Jenis Surat</th>
                            <th>Deskripsi</th>
                            <th>Tanggal Pengajuan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pengajuan as $surat)
                        <tr>
                            <td>{{ $surat->mahasiswa->user->name }}</td>
                            <td>{{ $surat->mahasiswa->nrp }}</td>
                            <td>{{ $surat->jenis_surat }}</td>
                            <td>{{ $surat->deskripsi }}</td>
                            <td>{{ $surat->created_at->format('d M Y') }}</td>
                            <td>
                                <a href="{{ route('tata_usaha.surat_detail', $surat->id) }}" class="btn btn-info btn-sm">Detail</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>

                @if ($pengajuan->isEmpty())
                    <p class="text-center text-muted">Tidak ada surat yang perlu diunggah.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
