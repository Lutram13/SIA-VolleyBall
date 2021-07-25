<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Jadwal;

class Pelatih extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'namaPelatih',
        'alamat', 
        'nomorTelepon', 
        'tempatLahir',
        'tanggalLahir',
        'kelompokUsia',
        'image',    
    ];
    
    public function jadwal()
    {
        return $this->hasMany(Jadwal::class);
    }
}
