<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    use HasFactory;

    protected $table = 'admin'; // Tetap atau 'admins' jika pakai konvensi Laravel

    protected $fillable = [
        'user_id', // Tetap perlu untuk relasi login
    ];

    public $timestamps = true;

    // Relasi ke User (admin login via user)
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
