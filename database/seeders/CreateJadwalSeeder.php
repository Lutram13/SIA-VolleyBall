<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Jadwal;

class CreateJadwalSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jadwal = [
            [
                'namaPelatih_id' => 1,
                'kelompokUsia' => 12, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Selasa',
                'jamLatihan' => '16:00:00',
            ],
            [
                'namaPelatih_id' => 1,
                'kelompokUsia' => 12, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Kamis',
                'jamLatihan' => '16:00:00',
            ],
            [
                'namaPelatih_id' => 1,
                'kelompokUsia' => 12, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Sabtu',
                'jamLatihan' => '16:00:00',
            ],
            [
                'namaPelatih_id' => 2,
                'kelompokUsia' => 15, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Rabu',
                'jamLatihan' => '16:00:00',
            ],
            [
                'namaPelatih_id' => 2,
                'kelompokUsia' => 15, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Jumat',
                'jamLatihan' => '16:00:00',
            ],
            [
                'namaPelatih_id' => 2,
                'kelompokUsia' => 15, 
                'tempatLatihan' => 'Lapangan Banyumanik', 
                'hariLatihan' => 'Minggu',
                'jamLatihan' => '16:00:00',
            ],
        ];
  
        foreach ($jadwal as $key => $value) {
            Jadwal::create($value);
        }
    }
}
