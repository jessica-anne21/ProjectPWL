<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{

    public function mahasiswa()
    {
        return $this->hasOne(Mahasiswa::class, 'user_id');
    }

    public function kaprodi()
    {
        return $this->hasOne(Kaprodi::class, 'user_id');
    }

    public function tataUsaha()
    {
        return $this->hasOne(TataUsaha::class, 'user_id');
    }
    
}
