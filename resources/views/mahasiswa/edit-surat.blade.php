@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit Surat</h3>
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
                
                <form action="{{ route('mahasiswa.surat.update', $surat->id) }}" method="POST">
                    @csrf
                    @method('PUT') <!-- Pastikan menggunakan method PUT -->

                    <div class="mb-3">
                        <label for="jenis_surat" class="form-label">Jenis Surat</label>
                        <select name="jenis_surat" class="form-control" required>
                            <option value="Surat Keterangan Mahasiswa Aktif" {{ $surat->jenis_surat == 'Surat Keterangan Mahasiswa Aktif' ? 'selected' : '' }}>Surat Keterangan Mahasiswa Aktif</option>
                            <option value="Surat Pengantar Tugas Mata Kuliah" {{ $surat->jenis_surat == 'Surat Pengantar Tugas Mata Kuliah' ? 'selected' : '' }}>Surat Pengantar Tugas Mata Kuliah</option>
                            <option value="Surat Keterangan Lulus" {{ $surat->jenis_surat == 'Surat Keterangan Lulus' ? 'selected' : '' }}>Surat Keterangan Lulus</option>
                            <option value="Laporan Hasil Studi" {{ $surat->jenis_surat == 'Laporan Hasil Studi' ? 'selected' : '' }}>Laporan Hasil Studi</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="deskripsi" class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi" rows="3" required>{{ old('deskripsi', $surat->deskripsi) }}</textarea>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Update</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
