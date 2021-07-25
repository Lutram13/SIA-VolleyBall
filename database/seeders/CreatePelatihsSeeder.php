<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pelatih;

class CreatePelatihsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $pelatih = [
            [
                'namaPelatih' => 'SUNARNO',
                'alamat' => 'SRONDOL KULON RT 04/10', 
                'nomorTelepon' => '081326422267', 
                'tempatLahir' => 'SEMARANG',
                'tanggalLahir' => '1979-03-14 00:00:00',
                'kelompokUsia' => 12,
                'image' => 'SUNARNO.jpg',  
            ],
            [
                'namaPelatih' => 'Atin Nurhidayanto',
                'alamat' => 'Jl Ngesrep Barat IV/99D RT 8/9 Srondol Kulon', 
                'nomorTelepon' => '0811292004', 
                'tempatLahir' => 'Banyumas',
                'tanggalLahir' => '1975-02-05 00:00:00',
                'kelompokUsia' => 17,
                'image' => 'Nurhidayanto.jpg',  
            ],
            [
                'namaPelatih' => 'Sudarsono',
                'alamat' => 'Jl mangga dlm selatan rt 07/02 srondol wetan banyumanik smg', 
                'nomorTelepon' => '081805913500', 
                'tempatLahir' => 'Demak',
                'tanggalLahir' => '1978-08-08 00:00:00',
                'kelompokUsia' => 15,
                'image' => 'Sudarsono.jpg',  
            ],
            [
                'namaPelatih' => 'JUMAIN',
                'alamat' => 'SRONDOL KULON RT :03/10', 
                'nomorTelepon' => '081298737840', 
                'tempatLahir' => 'SEMARANG',
                'tanggalLahir' => '1973-03-09 00:00:00',
                'kelompokUsia' => 17,
                'image' => 'JUMAIN.jpg',  
            ],            
        ];
  
        foreach ($pelatih as $key => $value) {
            Pelatih::create($value);
        }
    }
}
