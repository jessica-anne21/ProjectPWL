<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\Mahasiswa;
use App\Models\Kaprodi;
use App\Models\TataUsaha;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Http\Controllers\Controller;
use App\Models\ProgramStudi;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|string|email|max:255|unique:users',
        'password' => 'required|string|min:8|confirmed',
        'role_id' => 'required|integer|in:1,2,3,4', 
        'nrp' => 'nullable|string|unique:mahasiswa,nrp',
        'id_kaprodi' => 'nullable|string|unique:kaprodi,id_kaprodi',
        'id_tu' => 'nullable|string|unique:tata_usaha,id_tu',
        'id_admin' => 'nullable|string|unique:admin,id_admin',
        'program_studi_id' => 'nullable|integer|exists:prodi,id'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role_id' => $request->role_id
    ]);

    if ($request->role_id == 1) { 
        Admin::create([
            'user_id' => $user->id,
            'id_admin' => $request->id_admin ?? null,
            'name' => $request->name,
            'program_studi_id' => $request->program_studi_id, 
        ]);
        return redirect()->route('admin.dashboard');
    } elseif ($request->role_id == 2) { 
        Mahasiswa::create([
            'user_id' => $user->id,
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'program_studi_id' => $request->program_studi_id
        ]);
        return redirect()->route('dashboard.mahasiswa');
    } elseif ($request->role_id == 3) { 
        Kaprodi::create([
            'user_id' => $user->id,
            'id_kaprodi' => $request->id_kaprodi ?? null,
            'name' => $request->name,
            'program_studi_id' => $request->program_studi_id, 
        ]);
        return redirect()->route('dashboard.ketua_prodi');
    } elseif ($request->role_id == 4) { 
        TataUsaha::create([
            'user_id' => $user->id,
            'id_tata_usaha' => $request->id_tata_usaha ?? null,
            'name' => $request->name,
            'program_studi_id' => $request->program_studi_id, 
        ]);
        return redirect()->route('dashboard.tata_usaha');
    }

    return redirect('/');
}


    public function showMahasiswaRegister()
    {
        return view('auth.register-mahasiswa');
    }

    public function showKaprodiRegister()
    {
        return view('auth.register-kaprodi');
    }

    public function showTURegister()
    {
        return view('auth.register-tu');
    }

    public function showAdminRegister()
    {
        return view('auth.register-admin');
    }

    private function getRoleId($role)
{
    $roles = [
        'Admin' => 1,
        'Mahasiswa' => 2,
        'Ketua Prodi' => 3,
        'Tata Usaha' => 4,
    ];

    return $roles[$role] ?? null;
}



}
