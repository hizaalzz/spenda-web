<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Jurusan;

class JurusanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $jurusan1 = new Jurusan();
        $jurusan1->kode_tingkat = 'VII';
        $jurusan1->nama = 'VII';
        $jurusan1->save();
        $jurusan1->matapelajaran()->attach([1,3]);
    

        $jurusan2 = new Jurusan();
        $jurusan2->kode_tingkat = 'VIII';
        $jurusan2->nama = 'VIII';
        $jurusan2->save();
        $jurusan2->matapelajaran()->attach([1,2]);
        

        $jurusan3 = new Jurusan();
        $jurusan3->kode_tingkat = 'IX';
        $jurusan3->nama = 'IX';
        $jurusan3->save();
        $jurusan3->matapelajaran()->attach([1,2]);
        
    }
}
