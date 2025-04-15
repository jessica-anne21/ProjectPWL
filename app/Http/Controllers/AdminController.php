<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use App\Models\ProgramStudi;

class AdminController extends Controller
{
    public function index()
{
    // Pastikan hanya admin yang bisa melihat data ini
    if (Auth::user()->role_id !== 1) {
        return abort(403, 'Unauthorized');
    }

    // Ambil semua user tanpa memfilter berdasarkan program_studi_id
    $users = User::whereHas('mahasiswa')
        ->orWhereHas('kaprodi')
        ->orWhereHas('tataUsaha')
        ->get();

    return view('admin.users.index', compact('users'));
}



public function create()
{
    $prodi = ProgramStudi::all();
    return view('admin.users.create', compact('prodi'));
}

public function store(Request $request)
{
    // Pastikan hanya admin yang bisa menambahkan user
    if (Auth::user()->role_id !== 1) {
        return abort(403, 'Unauthorized');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|min:6|confirmed',
        'role_id' => ['required', Rule::in([2, 3, 4])], // Hanya Mahasiswa (2), Kaprodi (3), TU (4)
        'nrp' => 'required_if:role_id,2|nullable|string|unique:mahasiswa,nrp',
        'id_kaprodi' => 'required_if:role_id,3|nullable|string|unique:kaprodi,id_kaprodi',
        'id_tata_usaha' => 'required_if:role_id,4|nullable|string|unique:tata_usaha,id_tata_usaha',
        'program_studi_id' => 'required_if:role_id,2,3,4|exists:prodi,id',
    ]);

    // Buat user baru
    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id,
    ]);
    
    // Jika user adalah Mahasiswa
    if ($request->role_id == 2) {
        Mahasiswa::create([
            'user_id' => $user->id,
            'nrp' => $request->nrp,
            'program_studi_id' => $request->program_studi_id,
        ]);
    }

    // Jika user adalah Kaprodi
    if ($request->role_id == 3) {
        \App\Models\Kaprodi::create([
            'user_id' => $user->id,
            'id_kaprodi' => $request->id_kaprodi,
            'program_studi_id' => $request->program_studi_id,
        ]);
    }

    // Jika user adalah Tata Usaha
    if ($request->role_id == 4) {
        \App\Models\TataUsaha::create([
            'user_id' => $user->id,
            'id_tata_usaha' => $request->id_tata_usaha,
            'program_studi_id' => $request->program_studi_id,
        ]);
    }

    return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
}


    public function edit(User $user)
{
    if (Auth::user()->role_id !== 1) {
        return abort(403, 'Unauthorized');
    }
    
    return view('admin.users.edit', compact('user'));
}

public function update(Request $request, User $user)
{
    if (Auth::user()->role_id !== 1) {
        return abort(403, 'Unauthorized');
    }

    $request->validate([
        'name' => 'required|string|max:255',
        'email' => ['required', 'email', Rule::unique('users')->ignore($user->id)],
        'role_id' => ['required', Rule::in([2, 3, 4])], // Hanya bisa edit Mahasiswa, Kaprodi, dan TU
    ]);

    $user->update([
        'name' => $request->name,
        'email' => $request->email,
        'role_id' => $request->role_id,
    ]);

    return redirect()->route('admin.users.index')->with('success', 'User berhasil diperbarui.');
}

public function destroy(User $user)
{
    if (Auth::user()->role_id !== 1) {
        return abort(403, 'Unauthorized');
    }

    // Hapus data terkait di tabel lain
    if ($user->role_id == 2) {
        Mahasiswa::where('user_id', $user->id)->delete();
    } elseif ($user->role_id == 3) {
        \App\Models\Kaprodi::where('user_id', $user->id)->delete();
    } elseif ($user->role_id == 4) {
        \App\Models\TataUsaha::where('user_id', $user->id)->delete();
    }

    $user->delete();

    return redirect()->route('admin.users.index')->with('success', 'User berhasil dihapus.');
}


}
