<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nilai;

class CreateNilaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $nilai = [
            [
                'anggota_id' => 1,
                'passingAtas' => 80, 
                'passingBawah' => 80, 
                'blocking' => 80,
                'servis' => 80,
                'rataRata' => 80,
            ],
            [
                'anggota_id' => 2,
                'passingAtas' => 74, 
                'passingBawah' => 74, 
                'blocking' => 74,
                'servis' => 74,
                'rataRata' => 74,
            ],
            [
                'anggota_id' => 3,
                'passingAtas' => 83, 
                'passingBawah' => 83, 
                'blocking' => 83,
                'servis' => 83,
                'rataRata' => 83,
            ],
            [
                'anggota_id' => 4,
                'passingAtas' => 78, 
                'passingBawah' => 78, 
                'blocking' => 78,
                'servis' => 78,
                'rataRata' => 78,
            ],
            [
                'anggota_id' => 5,
                'passingAtas' => 90, 
                'passingBawah' => 90, 
                'blocking' => 90,
                'servis' => 90,
                'rataRata' => 90,
            ],
            
        ];
  
        foreach ($nilai as $key => $value) {
            Nilai::create($value);
        }
    }
}
