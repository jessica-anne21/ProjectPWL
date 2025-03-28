@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
        <div class="page-header">
            <h3 class="fw-bold mb-3">Edit User</h3>
        </div>

        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-3">
                        <label for="role_id" class="form-label">Role</label>
                        <select name="role_id" id="role_id" class="form-control" required>
                            <option value="2" {{ $user->role_id == 2 ? 'selected' : '' }}>Mahasiswa</option>
                            <option value="3" {{ $user->role_id == 3 ? 'selected' : '' }}>Ketua Prodi</option>
                            <option value="4" {{ $user->role_id == 4 ? 'selected' : '' }}>Tata Usaha</option>
                        </select>
                    </div>

                    <!-- Field tambahan berdasarkan role -->
                    <div class="mb-3" id="nrp_field" style="display: none;">
                        <label for="nrp" class="form-label">NRP</label>
                        <input type="text" name="nrp" class="form-control" value="{{ $user->mahasiswa->nrp ?? '' }}">
                    </div>

                    <div class="mb-3" id="kaprodi_id_field" style="display: none;">
                        <label for="kaprodi_id" class="form-label">ID Kaprodi</label>
                        <input type="text" name="kaprodi_id" class="form-control" value="{{ $user->kaprodi->id ?? '' }}">
                    </div>

                    <div class="mb-3" id="tu_id_field" style="display: none;">
                        <label for="tu_id" class="form-label">ID Tata Usaha</label>
                        <input type="text" name="tu_id" class="form-control" value="{{ $user->tataUsaha->id ?? '' }}">
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama</label>
                        <input type="text" name="name" class="form-control" value="{{ $user->name }}" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" value="{{ $user->email }}" required>
                    </div>

                    

                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">Batal</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function () {
    let roleSelect = document.getElementById("role_id");
    let nrpField = document.getElementById("nrp_field");
    let kaprodiField = document.getElementById("kaprodi_id_field");
    let tuField = document.getElementById("tu_id_field");

    function toggleFields() {
        let role = roleSelect.value;
        nrpField.style.display = (role == "2") ? "block" : "none";
        kaprodiField.style.display = (role == "3") ? "block" : "none";
        tuField.style.display = (role == "4") ? "block" : "none";
    }

    roleSelect.addEventListener("change", toggleFields);
    toggleFields(); // Panggil saat halaman pertama kali dimuat
});
</script>

@endsection
