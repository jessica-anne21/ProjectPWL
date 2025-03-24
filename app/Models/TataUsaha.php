<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TataUsaha extends Model
{
    use HasFactory;

    protected $table = 'tata_usaha'; 

    protected $fillable = ['id_tata_usaha', 'user_id', 'program_studi_id', 'created_at', 'updated_at'];

    public $timestamps = true;

    // Relasi ke User
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    // Relasi ke Program Studi
    public function prodi()
    {
        return $this->belongsTo(Prodi::class, 'program_studi_id', 'id');
    }
}
