<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanSurat extends Model
{
    use HasFactory;

    protected $table = 'pengajuan_surat';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'nrp', 'jenis_surat', 'deskripsi', 'status', 'file_surat'
    ];

    public function mahasiswa()
    {
        return $this->belongsTo(Mahasiswa::class, 'nrp', 'nrp');
    }

    

}
