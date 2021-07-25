<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Anggota;


class CreateAnggotaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $anggota = [
            [
                'nama' => 'Anggota',
                'alamat' => 'Banyumanik', 
                'tempatLahir' => 'Banyumanik', 
                'tanggalLahir' => '1997-06-05 17:12:02',
                'umur' => 24,
                'pendidikan' => 'Sarjana',
                'tinggiBadan' => 200,  
                'beratBadan' => 80,  
                'kelompokUsia' => 12,  
            ],
            [
                'nama' => 'Anggota 2',
                'alamat' => 'Banyumanik', 
                'tempatLahir' => 'Banyumanik', 
                'tanggalLahir' => '1997-06-05 17:12:02',
                'umur' => 24,
                'pendidikan' => 'Sarjana',
                'tinggiBadan' => 200,  
                'beratBadan' => 80,  
                'kelompokUsia' => 17,  
            ],
            [
                'nama' => 'Anggota 3',
                'alamat' => 'Banyumanik', 
                'tempatLahir' => 'Banyumanik', 
                'tanggalLahir' => '1997-06-05 17:12:02',
                'umur' => 24,
                'pendidikan' => 'Sarjana',
                'tinggiBadan' => 200,  
                'beratBadan' => 80,  
                'kelompokUsia' => 15,  
            ],
            [
                'nama' => 'Anggota 4',
                'alamat' => 'Banyumanik', 
                'tempatLahir' => 'Banyumanik', 
                'tanggalLahir' => '1997-06-05 17:12:02',
                'umur' => 24,
                'pendidikan' => 'Sarjana',
                'tinggiBadan' => 200,  
                'beratBadan' => 80,  
                'kelompokUsia' => 17,  
            ],
            [
                'nama' => 'Anggota 5',
                'alamat' => 'Banyumanik', 
                'tempatLahir' => 'Banyumanik', 
                'tanggalLahir' => '1997-06-05 17:12:02',
                'umur' => 24,
                'pendidikan' => 'Sarjana',
                'tinggiBadan' => 200,  
                'beratBadan' => 80,  
                'kelompokUsia' => 17,  
            ],   
            
        ];
  
        foreach ($anggota as $key => $value) {
            Anggota::create($value);
        }
    }
}
