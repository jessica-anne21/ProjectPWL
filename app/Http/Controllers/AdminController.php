<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Mahasiswa;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AdminController extends Controller
{
    public function index()
    {
        // Hanya tampilkan user dengan program studi yang sama dengan admin yang sedang login
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
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
            'nrp' => 'nullable|required_if:role_id,2|unique:mahasiswa,nrp', // Khusus Mahasiswa
        ]);

        // Buat user baru
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
            'program_studi_id' => Auth::user()->program_studi_id, // Harus sesuai dengan admin yang login
        ]);

        // Jika user yang dibuat adalah Mahasiswa, tambahkan data mahasiswa
        if ($request->role_id == 2) {
            Mahasiswa::create([
                'user_id' => $user->id,
                'nrp' => $request->nrp,
                'program_studi_id' => $user->program_studi_id,
            ]);
        }

        return redirect()->route('admin.users.index')->with('success', 'User berhasil ditambahkan.');
    }
}
