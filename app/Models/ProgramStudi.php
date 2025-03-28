<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramStudi extends Model
{
    use HasFactory;

    protected $table = 'prodi'; // Pastikan nama tabel benar
    protected $primaryKey = 'id'; // Sesuaikan primary key (opsional, default sudah 'id')

    protected $fillable = ['nama_prodi']; // Sesuaikan dengan kolom di database

    public function users()
    {
        return $this->hasMany(User::class, 'program_studi_id'); 
    }
}
