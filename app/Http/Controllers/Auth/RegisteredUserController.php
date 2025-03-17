<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
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

    

    // public function create()
    // {
    //     $programStudis = ProgramStudi::all();
    //     return view('auth.register', compact('programStudis'));
    // }


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
        'role' => 'required|in:Mahasiswa,Ketua Prodi,Tata Usaha',
        'nrp' => 'nullable|string|unique:mahasiswa,nrp',
        'id_kaprodi' => 'nullable|string|unique:kaprodi,id_kaprodi',
        'id_tu' => 'nullable|string|unique:tata_usaha,id_tu'
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role
    ]);

    if ($request->role === 'Mahasiswa') {
        Mahasiswa::create([
            'nrp' => $request->nrp,
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
            'program_studi_id' => $request->program_studi_id
        ]);
        return redirect()->route('dashboard.mahasiswa');
    
    } elseif ($request->role === 'Ketua Prodi') {
        Kaprodi::create([
            'user_id' => $user->id,
            'id_kaprodi' => $request->id_kaprodi,
            'name' => $request->name
        ]);
        return redirect()->route('dashboard.ketua_prodi');
    } elseif ($request->role === 'Tata Usaha') {
        TataUsaha::create([
            'user_id' => $user->id,
            'id_tu' => $request->id_tu,
            'name' => $request->name
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


    
}
