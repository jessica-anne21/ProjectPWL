@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Selamat datang, {{ Auth::user()->name }}!</h3>
        </div>

        <!-- Tabel Riwayat Surat -->
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Riwayat Pengajuan Surat</h4>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Jenis Surat</th>
                                <th>Deskripsi</th>
                                <th>Status</th>
                                <th>Tanggal Pengajuan</th>
                                <th>File Surat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($riwayat_surat as $index => $surat)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $surat->jenis_surat ?? '-' }}</td>
                                    <td>{{ $surat->deskripsi ?? 'Tidak ada deskripsi' }}</td>
                                    <td>
                                        @php
                                            $status = strtolower($surat->status ?? 'unknown');
                                        @endphp
                                        @if($status == 'diajukan')
                                            <span class="badge bg-warning">Diajukan</span>
                                        @elseif($status == 'disetujui')
                                            <span class="badge bg-success">Disetujui</span>
                                        @elseif($status == 'ditolak')
                                            <span class="badge bg-danger">Ditolak</span>
                                        @else
                                            <span class="badge bg-secondary">Status Tidak Diketahui</span>
                                        @endif
                                    </td>
                                    <td>{{ $surat->created_at ? \Carbon\Carbon::parse($surat->created_at)->format('d M Y') : '-' }}</td>
                                    <td>
                                        @if (!empty($surat->file_surat))
                                            <a href="{{ asset('uploads/surat/' . $surat->file_surat) }}" target="_blank" class="btn btn-primary btn-sm">
                                                Download
                                            </a>
                                        @else
                                            <span class="text-muted">Belum tersedia</span>
                                        @endif
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="text-center text-muted">Belum ada pengajuan surat</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
