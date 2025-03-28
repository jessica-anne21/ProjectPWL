@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Dashboard Ketua Program Studi</h3>
        </div>

        <!-- Statistik Pengajuan Surat -->
        <div class="row">
            <div class="col-md-4">
                <a href="{{ route('kaprodi.surat', ['status' => 'Menunggu Persetujuan']) }}" class="text-decoration-none">
                    <div class="card text-white bg-warning shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Menunggu Persetujuan</h5>
                            <p class="card-text fs-3 fw-bold">{{ $jumlah_menunggu }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('kaprodi.surat', ['status' => 'Disetujui']) }}" class="text-decoration-none">
                    <div class="card text-white bg-success shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Disetujui</h5>
                            <p class="card-text fs-3 fw-bold">{{ $jumlah_disetujui }}</p>
                        </div>
                    </div>
                </a>
            </div>
            <div class="col-md-4">
                <a href="{{ route('kaprodi.surat', ['status' => 'Ditolak']) }}" class="text-decoration-none">
                    <div class="card text-white bg-danger shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">Ditolak</h5>
                            <p class="card-text fs-3 fw-bold">{{ $jumlah_ditolak }}</p>
                        </div>
                    </div>
                </a>
            </div>
        </div>
    </div>
</div>
@endsection
