<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Nilai;
use Illuminate\Database\Eloquent\SoftDeletes;

class Anggota extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'nama',
        'alamat', 
        'tempatLahir',
        'tanggalLahir',
        'umur',
        'pendidikan',
        'tinggiBadan',
        'beratBadan',
        'kelompokUsia',
    ];
    
    public function nilai()
    {
        return $this->hasMany(Nilai::class);
    }
}
