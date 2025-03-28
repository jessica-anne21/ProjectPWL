@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Tambah Pengguna</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('users.store') }}" method="POST">
                    @csrf
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
                        <label for="id_prodi" class="form-label">ID Program Studi</label>
                        <input type="text" name="id_prodi" id="id_prodi" class="form-control">
                    </div>

                    <div class="mb-3" id="idTUField" style="display: none;">
                        <label for="id_tu" class="form-label">ID Tata Usaha</label>
                        <input type="text" name="id_tu" id="id_tu" class="form-control">
                    </div>

                    <button type="submit" class="btn btn-primary">Simpan</button>
                    <a href="{{ route('users.index') }}" class="btn btn-secondary">Batal</a>
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
    }
</script>

@endsection
