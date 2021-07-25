<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        $this->call(CreateUsersSeeder::class);
        $this->call(CreatePelatihsSeeder::class);
        $this->call(CreateAnggotaSeeder::class);
        $this->call(CreateNilaiSeeder::class);
        $this->call(CreateJadwalSeeder::class);
    }
}
