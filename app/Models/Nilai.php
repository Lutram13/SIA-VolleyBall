<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Anggota;

class Nilai extends Model
{
    use HasFactory;

    protected $fillable = [         
        'anggota_id',
        'passingAtas',
        'passingBawah',
        'blocking',
        'servis',
        'rataRata',
    ];    
    
    public function anggota()
    {
        return $this->belongsTo(Anggota::class);
    }
}
