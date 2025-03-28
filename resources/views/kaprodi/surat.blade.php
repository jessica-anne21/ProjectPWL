@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Surat {{ $status }}</h3>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Mahasiswa</th>
                    <th>NRP</th>
                    <th>Jenis Surat</th>
                    <th>Tanggal Pengajuan</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pengajuan as $key => $s)
                <tr>
                    <td>{{ $key+1 }}</td>
                    <td>{{ $s->mahasiswa->user->name }}</td>
                    <td>{{ $s->mahasiswa->nrp }}</td>
                    <td>{{ $s->jenis_surat }}</td>
                    <td>{{ $s->created_at->format('d M Y') }}</td>
                    <td>{{ $s->status }}</td>
                    <td>
                        <a href="{{ route('surat.detail', $s->id) }}" class="btn btn-primary btn-sm">Lihat Detail</a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
