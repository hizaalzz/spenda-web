<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Matapelajaran;

class MatapelajaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            ['nama' => 'Bahasa Indonesia'],
            ['nama' => 'Bahasa Inggris'],
            ['nama' => 'Matematika'],
            ['nama' => 'Prakarya'],
            ['nama' => 'PJOK'],
            ['nama' => 'PKN'],
            ['nama' => 'IPA'],
            ['nama' => 'IPS'],
            ['nama' => 'Agama'],
            ['nama' => 'BK'],
            
            
        ];

        Matapelajaran::insert($data);
    }
}
