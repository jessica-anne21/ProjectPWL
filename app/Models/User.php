<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'users'; 

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'program_studi_id', 
    ];

    protected $primaryKey = 'id';

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

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

    public function programStudi()
    {
        return $this->belongsTo(ProgramStudi::class, 'program_studi_id');
    }
}
