@extends('layouts.index')

@section('content')
<div class="container">
    <div class="page-inner">
    <div class="page-header d-flex justify-content-between align-items-center">
        <h3 class="fw-bold mb-3">Manajemen Pengguna</h3>
        <a href="{{ route('admin.users.create') }}" class="btn btn-primary">Tambah User</a>
    </div>

        <!-- Tabel Data Pengguna -->
        <div class="card">
            <div class="card-body">
                <table class="table table-bordered">
                <thead>
    <tr>
        <th>No</th>
        <th>NRP/NIP</th>
        <th>Nama</th>
        <th>Email</th>
        <th>Role</th>
        <th>Program Studi</th> {{-- Tambahkan ini --}}
        <th>Action</th>
    </tr>
</thead>
<tbody>
    @foreach($users as $index => $user)
    <tr>
        <td>{{ $index + 1 }}</td>
        <td>
            {{-- Menampilkan ID sesuai dengan role pengguna --}}
            @if($user->role_id == 2 && $user->mahasiswa)
                {{ $user->mahasiswa->nrp }}
            @elseif($user->role_id == 3 && $user->kaprodi)
                {{ $user->kaprodi->id_kaprodi }}
            @elseif($user->role_id == 4 && $user->tatausaha)
                {{ $user->tatausaha->id_tata_usaha }}
            @else
                -
            @endif
        </td>
        <td>{{ $user->name }}</td>
        <td>{{ $user->email }}</td>
        <td>
            @if($user->role_id == 1) Admin
            @elseif($user->role_id == 2) Mahasiswa
            @elseif($user->role_id == 3) Ketua Prodi
            @else Tata Usaha
            @endif
        </td>
        <td>
            @if($user->role_id == 2 && $user->mahasiswa)
                {{ $user->mahasiswa->programStudi->nama_prodi ?? '-' }}
            @elseif($user->role_id == 3 && $user->kaprodi)
                {{ $user->kaprodi->programStudi->nama_prodi ?? '-' }}
            @elseif($user->role_id == 4 && $user->tatausaha)
                {{ $user->tatausaha->programStudi->nama_prodi ?? '-' }}
            @else
                -
            @endif
        </td>
        <td>
            <a href="{{ route('admin.users.edit', $user->id) }}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus user ini?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</tbody>

                </table>
            </div>
        </div>
    </div>
</div>
@endsection
