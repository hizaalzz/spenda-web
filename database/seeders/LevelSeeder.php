<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Level;

class LevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $level = new Level();
        $level->nama = 'Kelas 1';
        $level->skala = 1;

        $level->save();
    }
}
