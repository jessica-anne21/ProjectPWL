@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Ajukan Surat</h3>
        </div>
        
        <div class="card">
            <div class="card-body">
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('mahasiswa.surat.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="mb-3">
                        <label for="jenis_surat" class="form-label">Jenis Surat</label>
                        <select name="jenis_surat" class="form-control" required>
                            <option value="Surat Keterangan Mahasiswa Aktif">Surat Keterangan Mahasiswa Aktif</option>
                            <option value="Surat Pengantar Tugas Mata Kuliah">Surat Pengantar Tugas Mata Kuliah</option>
                            <option value="Surat Keterangan Lulus">Surat Keterangan Lulus</option>
                            <option value="Laporan Hasil Studi">Laporan Hasil Studi</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" required></textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Kirim</button>
                </form>
            </div>
        </div>

        
        
</div>
@endsection
