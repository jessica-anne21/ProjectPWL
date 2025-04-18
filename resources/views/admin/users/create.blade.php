@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tambah Pengguna</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.users.store') }}" method="POST">
                    @csrf

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-control" required onchange="toggleFields()">
                            <option value="1">Admin</option>
                            <option value="2">Mahasiswa</option>
                            <option value="3">Ketua Prodi</option>
                            <option value="4">Tata Usaha</option>
                        </select>
                    </div>

                    <div class="mb-3" id="nrpField" style="display: none;">
                        <label for="nrp" class="form-label">NRP</label>
                        <input type="text" name="nrp" id="nrp" class="form-control">
                    </div>

                    <div class="mb-3" id="idProdiField" style="display: none;">
                        <label for="id_kaprodi" class="form-label">ID Ketua Prodi</label>
                        <input type="text" name="id_kaprodi" id="id_kaprodi" class="form-control">
                    </div>

                    <div class="mb-3" id="idTUField" style="display: none;">
                        <label for="id_tata_usaha" class="form-label">ID Tata Usaha</label>
                        <input type="text" name="id_tata_usaha" id="id_tata_usaha" class="form-control">
                    </div>

                    <div class="mb-3" id="prodiField" style="display: none;">
                        <label for="program_studi_id" class="form-label">Program Studi</label>
                        <select name="program_studi_id" id="program_studi_id" class="form-control">
                            <option value="">-- Pilih Program Studi --</option>
                            @foreach ($prodi as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_prodi }}</option>
                            @endforeach
                        </select>
                    </div>


                    
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password</label>
                        <input type="password" name="password_confirmation" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleFields() {
        let role = document.getElementById('role_id').value;

        document.getElementById('nrpField').style.display = (role == 2) ? 'block' : 'none';
        document.getElementById('idProdiField').style.display = (role == 3) ? 'block' : 'none';
        document.getElementById('idTUField').style.display = (role == 4) ? 'block' : 'none';
        document.getElementById('prodiField').style.display = (role == 2 || role == 3 || role == 4) ? 'block' : 'none';
    }

    // Panggil saat pertama kali halaman diload
    document.addEventListener('DOMContentLoaded', function () {
        toggleFields();
    });
</script>


@endsection
