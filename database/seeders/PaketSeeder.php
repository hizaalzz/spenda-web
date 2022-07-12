<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Paket;

class PaketSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Paket::create([
            'kode_soal' => 'A',
        ]);

        Paket::create([
            'kode_soal' => 'B'
        ]);
    }
}
