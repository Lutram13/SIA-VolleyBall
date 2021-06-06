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
                'namaPelatih' => 'Pak Juna edi',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 15,
                'image' => 'IMG-20210525-WA0012.jpg',  
            ],
            [
                'namaPelatih' => 'Mr.Kumis',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 12,
                'image' => 'IMG-20210524-WA0003.jpg',  
            ],
            [
                'namaPelatih' => 'Pak Pro',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 17,
                'image' => 'IMG-20210525-WA0000.jpg',  
            ],
            [
                'namaPelatih' => 'Pak Karyo',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 17,
                'image' => 'IMG-20210524-WA0005.jpg',  
            ],
            [
                'namaPelatih' => 'Pak Pelatih',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 15,
                'image' => 'IMG-20210525-WA0002.jpg',  
            ],
            [
                'namaPelatih' => 'Pak Joko',
                'alamat' => 'Ungaran', 
                'nomorTelepon' => '089234028039', 
                'tempatLahir' => 'Bekasi',
                'tanggalLahir' => '1967-06-05 17:12:02',
                'kelompokUsia' => 12,
                'image' => 'IMG-20210525-WA0001.jpg',  
            ],
            
        ];
  
        foreach ($pelatih as $key => $value) {
            Pelatih::create($value);
        }
    }
}
