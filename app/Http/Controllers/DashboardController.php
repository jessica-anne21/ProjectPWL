<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        // Redirect sesuai peran
        if ($user->role_id == 1) {
            return redirect()->route('dashboard.admin');
        } elseif ($user->role_id == 2) {
            return redirect()->route('dashboard.mahasiswa');
        } elseif ($user->role_id == 3) {
            return redirect()->route('dashboard.ketua_prodi');
        } elseif ($user->role_id == 4) {
            return redirect()->route('dashboard.tata_usaha');
        }
        

        return abort(403, 'Unauthorized');
    }

    public function mahasiswa()
    {
        return view('dashboard.mahasiswa');
    }

    public function ketuaProdi()
    {
        return view('dashboard.ketua_prodi');
    }

    public function tataUsaha()
    {
        return view('dashboard.tata_usaha');
    }

    public function admin()
    {
        return view('dashboard.admin');
    }
}
