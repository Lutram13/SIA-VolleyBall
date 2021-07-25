<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pelatih;

class Jadwal extends Model
{
    use HasFactory;

    protected $fillable =[
        'namaPelatih_id',
        'kelompokUsia',
        'tempatLatihan',
        'hariLatihan',
        'jamLatihan'
    ];
    
    public function pelatih()
    {
        return $this->belongsTo(Pelatih::class);
    }
}
