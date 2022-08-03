<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Kelas;

class KelasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kelas1 = new Kelas();

        $kelas1->nama_kelas = 'VII A';
        $kelas1->jurusan_id = 1;
        $kelas1->level_id = 1;
        $kelas1->save();

        $kelas2 = new Kelas();

        $kelas2->nama_kelas = 'VIII A';
        $kelas2->jurusan_id = 2;
        $kelas2->level_id = 2;
        $kelas2->save();

        $kelas2 = new Kelas();

        $kelas2->nama_kelas = 'IX A';
        $kelas2->jurusan_id = 3;
        $kelas2->level_id = 3;
        $kelas2->save();
    }
}
