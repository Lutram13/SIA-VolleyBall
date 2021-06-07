<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
