<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\JenisUjian;

class JenisUjianSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        JenisUjian::create([
            'nama' => 'Ulangan Harian'
        ]);

        JenisUjian::create([
            'nama' => 'PTS'
        ]);

        JenisUjian::create([
            'nama' => 'PAS'
        ]);
    }
}
